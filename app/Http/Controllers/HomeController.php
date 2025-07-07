<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\Kategori;
use App\Transaksi;
use App\User;
use App\DataPendapatan;

use Hash;
use Auth;
use File;
use PDF;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Concerns\FromView;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $kategori = Kategori::all();
        $transaksi = Transaksi::all();
        $tanggal = date('Y-m-d');
        $bulan = date('m');
        $tahun = date('Y');

        $pemasukan_hari_ini = DB::table('transaksi')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('jenis','Pemasukan')
        ->whereDate('tanggal',$tanggal)
        ->first();

        $pemasukan_bulan_ini = DB::table('transaksi')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('jenis','Pemasukan')
        ->whereMonth('tanggal',$bulan)
        ->first();

        $pemasukan_tahun_ini = DB::table('transaksi')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('jenis','Pemasukan')
        ->whereYear('tanggal',$tahun)
        ->first();

        $seluruh_pemasukan = DB::table('transaksi')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('jenis','Pemasukan')
        ->first();

        $pengeluaran_hari_ini = DB::table('transaksi')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('jenis','Pengeluaran')
        ->whereDate('tanggal',$tanggal)
        ->first();

        $pengeluaran_bulan_ini = DB::table('transaksi')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('jenis','Pengeluaran')
        ->whereMonth('tanggal',$bulan)
        ->first();

        $pengeluaran_tahun_ini = DB::table('transaksi')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('jenis','Pengeluaran')
        ->whereYear('tanggal',$tahun)
        ->first();

        $seluruh_pengeluaran = DB::table('transaksi')
        ->select(DB::raw('SUM(nominal) as total'))
        ->where('jenis','Pengeluaran')
        ->first();

        return view('app.index',
            [
                'pemasukan_hari_ini' => $pemasukan_hari_ini, 
                'pemasukan_bulan_ini' => $pemasukan_bulan_ini,
                'pemasukan_tahun_ini' => $pemasukan_tahun_ini,
                'seluruh_pemasukan' => $seluruh_pemasukan,
                'pengeluaran_hari_ini' => $pengeluaran_hari_ini, 
                'pengeluaran_bulan_ini' => $pengeluaran_bulan_ini,
                'pengeluaran_tahun_ini' => $pengeluaran_tahun_ini,
                'seluruh_pengeluaran' => $seluruh_pengeluaran,
                'kategori' => $kategori,
                'transaksi' => $transaksi,
            ]
        );
    }

    public function kategori()
    {
        $kategori = Kategori::orderBy('kategori','asc')->get();
        $ships = \App\Models\Ship::orderBy('shipname','asc')->get();
        $loads_category = \App\Models\LoadsCategory::orderBy('load_name','asc')->get();
        $cities = \App\Models\City::orderBy('city_name','asc')->get();
        return view('app.kategori', [
            'kategori' => $kategori,
            'ships' => $ships,
            'loads_category' => $loads_category,
            'cities' => $cities
        ]);
    }

    public function kategori_aksi(Request $req)
    {
        $nama = $req->input('nama');
        // Cek duplikat kategori
        if (Kategori::where('kategori', $nama)->exists()) {
            return redirect('kategori')->with('error', 'Kategori sudah ada!');
        }
        Kategori::create(['kategori' => $nama]);
        return redirect('kategori')->with('success','Kategori telah disimpan');
    }

    public function kategori_update($id, Request $req)
    {
        $nama = $req->input('nama');
        $kategori = Kategori::find($id);
        $kategori->kategori = $nama;
        $kategori->save();
        return redirect('kategori')->with('success','Kategori telah diupdate');
    }

    public function kategori_delete($id)
    {
        $kategori = Kategori::find($id);
        $kategori->delete();

        $tt = Transaksi::where('kategori_id',$id)->get();

        if($tt->count() > 0){
            $transaksi = Transaksi::where('kategori_id',$id)->first();
            $transaksi->kategori_id = "1";
            $transaksi->save();
        }
        return redirect('kategori')->with('success','Kategori telah dihapus');
    }


    public function password()
    {
        return view('app.password');
    }

    public function password_update(Request $request)
    {

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
        // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
        //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success","Password telah diganti!");

    }


    public function transaksi()
    {
        $kategori = Kategori::orderBy('kategori','asc')->get();
        $transaksi = Transaksi::orderBy('id','desc')->get();
        return view('app.transaksi',['transaksi' => $transaksi, 'kategori' => $kategori]);
    }

    public function transaksi_aksi(Request $req)
    {
        $tanggal = $req->input('tanggal');
        $jenis = $req->input('jenis');
        $kategori = $req->input('kategori');
        $nominal = $req->input('nominal');
        $keterangan = $req->input('keterangan');

        Transaksi::create([
            'tanggal' => $tanggal,
            'jenis' => $jenis,
            'kategori_id' => $kategori,
            'nominal' => $nominal,
            'keterangan' => $keterangan,
        ]);

        return redirect()->back()->with("success","Transaksi telah disimpan!");
    }


    public function transaksi_update($id, Request $req)
    {
        $tanggal = $req->input('tanggal');
        $jenis = $req->input('jenis');
        $kategori = $req->input('kategori');
        $nominal = $req->input('nominal');
        $keterangan = $req->input('keterangan');

        $transaksi = Transaksi::find($id);
        $transaksi->tanggal = $tanggal;
        $transaksi->jenis = $jenis;
        $transaksi->kategori_id = $kategori;
        $transaksi->nominal = $nominal;
        $transaksi->keterangan = $keterangan;
        $transaksi->save();

        return redirect()->back()->with("success","Transaksi telah diupdate!");
    }

    public function transaksi_delete($id)
    {
        $transaksi = Transaksi::find($id);
        $transaksi->delete();
        return redirect()->back()->with("success","Transaksi telah dihapus!");
    }

    public function laporan(Request $request)
    {
        $query = DB::table('report')
            ->leftJoin('incomes', 'report.income_id', '=', 'incomes.income_id')
            ->leftJoin('ships', 'incomes.ship_id', '=', 'ships.ship_id')
            ->leftJoin('users', 'ships.captain_id', '=', 'users.id')
            ->leftJoin('loads', 'incomes.load_id', '=', 'loads.load_id')
            ->leftJoin('loads_category', 'loads.load_category_id', '=', 'loads_category.load_category_id')
            ->select(
                'report.report_id',
                'users.name',
                'incomes.total_income',
                'report.year',
                'report.month',
                'ships.shipname',
                'loads_category.load_name',
                'incomes.total_spending'
            );

        // Apply filters
        if ($request->filled('year')) {
            $query->where('report.year', $request->year);
        }

        if ($request->filled('month')) {
            $query->where('report.month', $request->month);
        }

        if ($request->filled('shipname')) {
            $query->where('ships.shipname', 'like', '%' . $request->shipname . '%');
        }

        if ($request->filled('load_name')) {
            $query->where('loads_category.load_name', 'like', '%' . $request->load_name . '%');
        }

        $laporan = $query->get();

        return view('app.laporan', [
            'laporan' => $laporan,
            'filters' => $request->all()
        ]);
    }

    public function input_laporan()
    {
        $incomes = DB::table('incomes')->orderBy('date', 'desc')->get();
        return view('app.input_laporan', compact('incomes'));
    }

    public function getIncomeData($id)
    {
        $income = DB::table('incomes')
            ->join('cities as cf', 'incomes.city_from_id', '=', 'cf.city_id')
            ->join('cities as ct', 'incomes.city_to_id', '=', 'ct.city_id')
            ->where('incomes.income_id', $id)
            ->select('incomes.*', 'cf.city_name as city_from', 'ct.city_name as city_to')
            ->first();

        $spendings = DB::table('spendings')
            ->where('income_id', $id)
            ->select('spending_name', 'spending_amount')
            ->get();

        return response()->json([
            'date' => $income->date,
            'city_from' => $income->city_from,
            'city_to' => $income->city_to,
            'total_spending' => $income->total_spending,
            'total_income' => $income->total_income,
            'spendings' => $spendings
        ]);
    }

    public function laporan_update_show($id)
    {
        // Ambil data report by ID
        $report = DB::table('report')
            ->where('report_id', $id)
            ->first();
    
        // Kalau data tidak ditemukan, tampilkan 404
        if (!$report) {
            abort(404);
        }
    
        // Ambil semua income
        $incomes = DB::table('incomes')->get();
    
        return view('app.laporan_update', compact('report', 'incomes'));
    }

    public function laporan_update(Request $request, $id)
    {
        // Validasi: pastikan income_id ada (opsional, tambahkan jika perlu)
        $request->validate([
            'income_id' => 'required|exists:incomes,income_id',
        ]);

        // Update income_id di tabel report
        $affected = DB::table('report')
            ->where('report_id', $id)
            ->update([
                'income_id' => $request->income_id,
            ]);

        // Redirect balik ke halaman laporan
        return redirect()->route('laporan')->with('success', 'Laporan berhasil diperbarui.');
    }

    public function laporan_delete($id)
    {
        // Cek dulu apakah data ada
        $report = DB::table('report')->where('report_id', $id)->first();

        if (!$report) {
            return redirect()->route('laporan')->with('error', 'Data laporan tidak ditemukan.');
        }

        // Hapus data
        DB::table('report')->where('report_id', $id)->delete();

        return redirect()->route('laporan')->with('success', 'Laporan berhasil dihapus.');
    }

    public function laporan_create(Request $request)
    {
        $income = DB::table('incomes')->where('income_id', $request->income_id)->first();

        if (!$income) return redirect()->back()->with('error', 'Income tidak ditemukan.');

        $date = new \DateTime($income->date);

        DB::table('report')->insert([
            'income_id' => $income->income_id,
            'year' => $date->format('Y'),
            'month' => $date->format('m'),
            'total' => $income->total_income - $income->total_spending,
            'ship_amount' => 1,
            'date_create' => now()
        ]);

        return redirect()->route('laporan')->with('success', 'Laporan berhasil disimpan.');
    }



    public function laporan_print()
    {       
        if(isset($_GET['kategori'])){
            $kategori = Kategori::orderBy('kategori','asc')->get();
            if($_GET['kategori'] == ""){
                $transaksi = Transaksi::whereDate('tanggal','>=',$_GET['dari'])
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->get();
            }else{
                $transaksi = Transaksi::where('kategori_id',$_GET['kategori'])
                ->whereDate('tanggal','>=',$_GET['dari'])
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->get();
            }
            // $transaksi = Transaksi::orderBy('id','desc')->get();
            return view('app.laporan_print',['transaksi' => $transaksi, 'kategori' => $kategori]);
        }
    }

    // public function laporan_excel()
    // {
    //     return Excel::download(new LaporanExport, 'Laporan.xlsx');
    // }

    public function laporan_pdf()
    {
        if(isset($_GET['kategori'])){
            $kategori = Kategori::orderBy('kategori','asc')->get();
            if($_GET['kategori'] == ""){
                $transaksi = Transaksi::whereDate('tanggal','>=',$_GET['dari'])
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->get();
            }else{
                $transaksi = Transaksi::where('kategori_id',$_GET['kategori'])
                ->whereDate('tanggal','>=',$_GET['dari'])
                ->whereDate('tanggal','<=',$_GET['sampai'])
                ->get();
            }
            // $transaksi = Transaksi::orderBy('id','desc')->get();
            // return view('app.laporan_print',['transaksi' => $transaksi, 'kategori' => $kategori]);
            $pdf = PDF::loadView('app.laporan_pdf', ['transaksi' => $transaksi, 'kategori' => $kategori]);
            return $pdf->download('Laporan Keuangan.pdf');
        }
        
    }


    public function user()
    {
        $user = User::all();
        return view('app.user',['user' => $user]);
    }

    public function user_add()
    {
        return view('app.user_tambah');
    }

    public function user_aksi(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:5',
            'level' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // menyimpan data file yang diupload ke variabel $file
        $file = $request->file('foto');
        
        // cek jika gambar kosong
        if($file != ""){
            // menambahkan waktu sebagai pembuat unik nnama file gambar
            $nama_file = time()."_".$file->getClientOriginalName();

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'gambar/user';
            $file->move($tujuan_upload,$nama_file);
        }else{
            $nama_file = "";
        }
 
 
        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => $request->level,
            'foto' => $nama_file
        ]);

        return redirect(route('user'))->with('success','User telah disimpan');
    }

    public function user_edit($id)
    {
        $user = User::find($id);
        return view('app.user_edit', ['user' => $user]);
    }

     public function user_update($id, Request $req)
    {
         $this->validate($req, [
            'nama' => 'required',
            'email' => 'required|email',
            'level' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $name = $req->input('nama');
        $email = $req->input('email');
        $password = $req->input('password');
        $level = $req->input('level');
        

        $user = User::find($id);
        $user->name = $name;
        $user->email = $email;
        if($password != ""){
            $user->password = bcrypt($password);
        }

        // menyimpan data file yang diupload ke variabel $file
        $file = $req->file('foto');
        
        // cek jika gambar tidak kosong
        if($file != ""){
            // menambahkan waktu sebagai pembuat unik nnama file gambar
            $nama_file = time()."_".$file->getClientOriginalName();

            // isi dengan nama folder tempat kemana file diupload
            $tujuan_upload = 'gambar/user';
            $file->move($tujuan_upload,$nama_file);

            // hapus file gambar lama
            File::delete('gambar/user/'.$user->foto);

            $user->foto = $nama_file;
        }
        $user->level = $level;
        $user->save();

        return redirect(route('user'))->with("success","User telah diupdate!");
    }

    public function user_delete($id)
    {
        $user = User::find($id);
        // hapus file gambar lama
        File::delete('gambar/user/'.$user->foto);
        $user->delete();

        return redirect(route('user'))->with("success","User telah dihapus!");
    }

    public function data_pendapatan(Request $request)
    {
        $query = DB::table('incomes')
            ->leftJoin('ships', 'incomes.ship_id', '=', 'ships.ship_id')
            ->leftJoin('loads', 'incomes.load_id', '=', 'loads.load_id')
            ->leftJoin('loads_category', 'loads.load_category_id', '=', 'loads_category.load_category_id')
            ->leftJoin('cities as cities_from', 'incomes.city_from_id', '=', 'cities_from.city_id')
            ->leftJoin('cities as cities_to', 'incomes.city_to_id', '=', 'cities_to.city_id')
            ->select(
                'ships.shipname as nama_kapal',
                'loads_category.load_name as jenis_muatan',
                'loads.rental_price as harga_per_ton',
                'loads.load_amount as jumlah_muatan',
                'incomes.total_income as total_pendapatan',
                'incomes.date',
                'incomes.income_id',
                'cities_from.city_name as kota_asal',
                'cities_to.city_name as kota_tujuan'
            );
    
        if ($request->filled('search')) {
            $query->where('ships.shipname', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('year')) {
            $query->whereYear('incomes.date', $request->year);
        }

        if ($request->filled('month')) {
            $query->whereMonth('incomes.date', $request->month);
        }

        $pendapatan = $query->get();

        return view('app.data_pendapatan', ['pendapatan' => $pendapatan]);
    }


    public function show_input_pendapatan()
    {
        $load_categories = DB::table('loads_category')->get();
        $cities = DB::table('cities')->get();
        $ships = DB::table('ships')->get();
        return view('app.input_pendapatan', compact('load_categories', 'cities', 'ships'));
    }


    public function input_pendapatan(Request $request)
    {
        $request->validate([
            'ship_id'              => 'required|integer|exists:ships,ship_id',
            'date'                 => 'required|date',
            'city_from_id'         => 'required|integer|exists:cities,city_id',
            'city_to_id'           => 'required|integer|exists:cities,city_id',
            'load_category_id'     => 'required|integer|exists:loads_category,load_category_id',
            'load_amount'          => 'required|integer|min:1',
            'rental_price'         => 'required|integer|min:0',
            'spending_name.*'      => 'required|string',
            'spending_amount.*'    => 'required|integer|min:0',
        ]);

        DB::beginTransaction();
        try {
            // 1. Ambil ship_id dari input
            $ship_id = $request->ship_id;

            // 2. Simpan muatan
            $load_id = DB::table('loads')->insertGetId([
                'load_category_id' => $request->load_category_id,
                'load_amount'      => $request->load_amount,
                'rental_price'     => $request->rental_price
            ]);

            // 3. Hitung total
            $total_rental   = $request->load_amount * $request->rental_price;
            $total_spending = array_sum($request->spending_amount);
            $total_income   = $total_rental - $total_spending;

            // 4. Simpan ke incomes
            $income_id = DB::table('incomes')->insertGetId([
                'ship_id'        => $ship_id,
                'date'           => $request->date,
                'load_id'        => $load_id,
                'city_from_id'   => $request->city_from_id,
                'city_to_id'     => $request->city_to_id,
                'total_rental'   => $total_rental,
                'total_spending' => $total_spending,
                'total_income'   => $total_income
            ]);

            // 5. Simpan spendings
            foreach ($request->spending_name as $i => $name) {
                DB::table('spendings')->insert([
                    'income_id'       => $income_id,
                    'spending_name'   => $name,
                    'spending_amount' => $request->spending_amount[$i]
                ]);
            }

            // 6. Simpan ke report
            $date = new \DateTime($request->date); // dari request langsung
            DB::table('report')->insert([
                'income_id'   => $income_id,
                'year'        => $date->format('Y'),
                'month'       => $date->format('m'),
                'total'       => $total_income,
                'ship_amount' => $request->load_amount,
                'date_create' => now()
            ]);

            DB::commit();
            return redirect()->route('data_pendapatan')->with('success', 'Data pendapatan berhasil disimpan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menyimpan: ' . $e->getMessage());
        }
    }



    public function show_edit_pendapatan($id)
    {
        $income = DB::table('incomes')->where('income_id', $id)->first();
        $ship = DB::table('ships')->where('ship_id', $income->ship_id)->first();
        $load = DB::table('loads')
            ->where('load_id', $income->load_id)
            ->first();
        $loadCategory = DB::table('loads_category')
            ->where('load_category_id', $load->load_category_id)
            ->first();
        $spendings = DB::table('spendings')->where('income_id', $id)->get();
    
        return view('app.edit_pendapatan', compact('income', 'ship', 'load', 'loadCategory', 'spendings'));
    }
    

    public function update_pendapatan(Request $request, $id)
    {
        
        $request->validate([
            'shipname'          => 'required|string',
            'date'              => 'required|date',
            'load_category_id'  => 'required|exists:loads_category,load_category_id',
            'load_amount'       => 'required|integer|min:1',
            'rental_price'      => 'required|integer|min:0',
            'spending_name.*'   => 'required|string',
            'spending_amount.*' => 'required|integer|min:0',
        ]);
        
        DB::beginTransaction();
        try {
            // Update kapal
            DB::table('ships')->where('ship_id', $request->ship_id)->update([
                'shipname' => $request->shipname
            ]);

            // Update muatan
            DB::table('loads')->where('load_id', $request->load_id)->update([
                'load_category_id' => $request->load_category_id,
                'load_amount'      => $request->load_amount,
                'rental_price'     => $request->rental_price
            ]);
            
            // Hapus pengeluaran lama
            DB::table('spendings')->where('income_id', $id)->delete();
            
            // Insert pengeluaran baru
            if ($request->has('spending_name') && is_array($request->spending_name)) {
                foreach ($request->spending_name as $i => $name) {
                    DB::table('spendings')->insert([
                        'income_id'       => $id,
                        'spending_name'   => $name,
                        'spending_amount' => $request->spending_amount[$i]
                    ]);
                }
            }
            
            
            // Hitung ulang
            $total_rental = $request->load_amount * $request->rental_price;
            $total_spending = array_sum($request->spending_amount ?? []);
            $total_income = $total_rental - $total_spending;
            
            // Update income
            DB::table('incomes')->where('income_id', $id)->update([
                'date'            => $request->date,
                'total_rental'    => $total_rental,
                'total_spending'  => $total_spending,
                'total_income'    => $total_income
            ]);

            DB::commit();
            return redirect()->route('data_pendapatan')->with('success', 'Data berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal update: ' . $e->getMessage());
        }
    }

    public function delete_spending($income_id, $spending_id)
    {
        DB::table('spendings')
            ->where('income_id', $income_id)
            ->where('spending_id', $spending_id)
            ->delete();
    
        return back()->with('success', 'Pengeluaran berhasil dihapus.');
    }
    
    public function delete_pendapatan($id)
    {
        DB::beginTransaction();
        try {
            // 1. Hapus spendings terkait
            DB::table('spendings')->where('income_id', $id)->delete();

            // 2. Ambil income untuk cek keberadaan dan foreign key
            $income = DB::table('incomes')->where('income_id', $id)->first();

            if (!$income) {
                return redirect()->route('data_pendapatan')->with('error', 'Data tidak ditemukan.');
            }

            // 3. Hapus report yang terkait
            DB::table('report')->where('income_id', $id)->delete();

            // 4. Hapus income
            DB::table('incomes')->where('income_id', $id)->delete();

            // 5. Hapus load (muatan) yang terkait
            DB::table('loads')->where('load_id', $income->load_id)->delete();

            // ⚠️ Kapal tidak perlu dihapus agar tidak menghapus kapal yang digunakan income lain
            // DB::table('ships')->where('ship_id', $income->ship_id)->delete();

            DB::commit();
            return redirect()->route('data_pendapatan')->with('success', 'Data pendapatan berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('data_pendapatan')->with('error', 'Gagal menghapus data: ' . $e->getMessage());
        }
    }


    public function kapal_aksi(Request $req)
    {
        $req->validate([
            'shipname' => 'required|string|max:255',
        ]);
        // Cek duplikat kapal
        if (\App\Models\Ship::where('shipname', $req->shipname)->exists()) {
            return redirect('kategori')->with('error', 'Nama kapal sudah ada!');
        }
        \App\Models\Ship::create([
            'shipname' => $req->shipname,
        ]);
        return redirect('kategori')->with('success','Kapal telah disimpan');
    }

    public function kapal_update($id, Request $req)
    {
        $req->validate([
            'shipname' => 'required|string|max:255',
        ]);
        $ship = \App\Models\Ship::where('ship_id', $id)->firstOrFail();
        $ship->shipname = $req->shipname;
        $ship->save();
        return redirect('kategori')->with('success','Kapal telah diupdate');
    }

    public function kapal_delete($id)
    {
        $ship = \App\Models\Ship::where('ship_id', $id)->firstOrFail();
        $ship->delete();
        return redirect('kategori')->with('success','Kapal telah dihapus');
    }

    public function muatan_aksi(Request $req)
    {
        $req->validate([
            'load_name' => 'required|string|max:255',
        ]);
        // Cek duplikat jenis muatan
        if (\App\Models\LoadsCategory::where('load_name', $req->load_name)->exists()) {
            return redirect('kategori')->with('error', 'Jenis muatan sudah ada!');
        }
        \App\Models\LoadsCategory::create([
            'load_name' => $req->load_name,
        ]);
        return redirect('kategori')->with('success','Jenis muatan telah disimpan');
    }

    public function muatan_update($id, Request $req)
    {
        $req->validate([
            'load_name' => 'required|string|max:255',
        ]);
        $muatan = \App\Models\LoadsCategory::where('load_category_id', $id)->firstOrFail();
        $muatan->load_name = $req->load_name;
        $muatan->save();
        return redirect('kategori')->with('success','Jenis muatan telah diupdate');
    }

    public function muatan_delete($id)
    {
        $muatan = \App\Models\LoadsCategory::where('load_category_id', $id)->firstOrFail();
        $muatan->delete();
        return redirect('kategori')->with('success','Jenis muatan telah dihapus');
    }
    public function kota_aksi(Request $req)
    {
        $req->validate([
            'city_name' => 'required|string|max:255',
        ]);
        \App\Models\City::create([
            'city_name' => $req->city_name,
        ]);
        return redirect('kategori')->with('success','Kota telah disimpan');
    }

    // Tambah: Fungsi aksi tambah rute
    public function rute_aksi(Request $req)
    {
        $req->validate([
            'city_name' => 'required|string|max:255',
        ]);
        // Cek duplikat rute
        if (\App\Models\City::where('city_name', $req->city_name)->exists()) {
            return redirect('kategori')->with('error', 'Nama rute sudah ada!');
        }
        \App\Models\City::create([
            'city_name' => $req->city_name,
        ]);
        return redirect('kategori')->with('success','Rute telah disimpan');
    }
    public function rute_update($id, Request $req)
    {
        $req->validate([
            'city_name' => 'required|string|max:255',
        ]);
        $kota = \App\Models\City::where('city_id', $id)->firstOrFail();
        $kota->city_name = $req->city_name;
        $kota->save();
        return redirect('kategori')->with('success','Rute telah diupdate');
    }

    public function rute_delete($id)
    {
        $kota = \App\Models\City::where('city_id', $id)->firstOrFail();
        $kota->delete();
        return redirect('kategori')->with('success','Rute telah dihapus');
    }
}