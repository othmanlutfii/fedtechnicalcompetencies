<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TechnicalcompController extends Controller
{
    public function index()
	{


        

    	$teccom = DB::table('teccom')
            ->join('dfindustri', 'teccom.pki', '=', 'dfindustri.pki')
            ->join('dfskillgroup', 'teccom.pkg', '=', 'dfskillgroup.pkg')
            ->join('dfsubskill', 'teccom.pks', '=', 'dfsubskill.pks')
            ->paginate();

        $dfindustri = DB::table('dfindustri')
            ->get();

        $dfskillgroup = DB::table('dfskillgroup')
            ->get();

        $dfsubskill = DB::table('dfsubskill')
            ->get();



        $cari = "";
        $c3 = "No filter";
        $c4 = "No filter";
        $keyw = " Seluruh Data";

        $gen4 = DB::table('generik4')
            ->join('dfindustri', 'generik4.pki', '=', 'dfindustri.pki')
            ->get();
        $gen5 = DB::table('generik5')
            ->join('dfindustri', 'generik5.pki', '=', 'dfindustri.pki')
            ->get();

        // dd($gen4);
		return view('welcome',['teccom' => $teccom,'keyw' => $keyw,  
        'cari' => $cari,
        'c3' => $c3,
        'c4' => $c4,
        'dfindustri' => $dfindustri,
        'dfskillgroup' => $dfskillgroup,
        'dfsubskill' => $dfsubskill,
        'gen4'=>$gen4,
        'gen5'=>$gen5]);
	}

	public function cari(Request $request)
	{

        $gen4 = DB::table('generik4')
            ->join('dfindustri', 'generik4.pki', '=', 'dfindustri.pki')
            ->get();

        $gen5 = DB::table('generik5')
            ->join('dfindustri', 'generik5.pki', '=', 'dfindustri.pki')
            ->get();

        $dfindustri = DB::table('dfindustri')
            ->get();

        $dfskillgroup = DB::table('dfskillgroup')
            ->get();

        $dfsubskill = DB::table('dfsubskill')
            ->get();

        $cari = $request->cari;
		$cari2 = $request->industri;
        $cari3= $request->Skill;
        $cari4 = $request->subskill;

        $keyw = $cari;


        // $checked = $_GET['industri'];

        if(! isset($_GET['industri']))
				{
                    $cari2 = DB::table('dfindustri')
                        ->pluck('pki');
                }

        if(! isset($_GET['Skill']))
				{
                    $cari3 = DB::table('dfskillgroup')
                        ->pluck('pkg');
				}

        if(! isset($_GET['subskill']))
				{
                    $cari4 = DB::table('dfsubskill')
                        ->pluck('pks');
				}


        

        


        // dd($_GET); 



        if(!($cari)) {
            $keyw = "Seluruh Data";
            if(!($cari2)) {
                if(!($cari3)) {
                    if(!($cari4)) {
                        $cari4 = "";
                        $cari3 = "";
                        $cari2 = "";
                        $cari = "";
                        $teccom = DB::table('teccom')
                        ->join('dfindustri', 'teccom.pki', '=', 'dfindustri.pki')
                        ->join('dfskillgroup', 'teccom.pkg', '=', 'dfskillgroup.pkg')
                        ->join('dfsubskill', 'teccom.pks', '=', 'dfsubskill.pks')
                        ->paginate(10);
                    }
                    else{
                        $cari3 = "";
                        $cari2 = "";
                        $cari = "";
                        $teccom = DB::table('teccom')
                            ->join('dfindustri', 'teccom.pki', '=', 'dfindustri.pki')
                            ->join('dfskillgroup', 'teccom.pkg', '=', 'dfskillgroup.pkg')
                            ->join('dfsubskill', 'teccom.pks', '=', 'dfsubskill.pks')
                            ->whereIn("teccom.pks",$cari4)
                            ->paginate(10);
                    }
                }
                else{

                    if(!($cari4)) {
                        $cari4 = "";
                        $cari2 = "";
                        $cari = "";
                        $teccom = DB::table('teccom')
                        ->join('dfindustri', 'teccom.pki', '=', 'dfindustri.pki')
                        ->join('dfskillgroup', 'teccom.pkg', '=', 'dfskillgroup.pkg')
                        ->join('dfsubskill', 'teccom.pks', '=', 'dfsubskill.pks')
                        ->whereIn("teccom.pkg",$cari3)
                        ->paginate(10);
                    }
                    else{
                        $cari2 = "";
                        $cari = "";
                        $teccom = DB::table('teccom')
                            ->join('dfindustri', 'teccom.pki', '=', 'dfindustri.pki')
                            ->join('dfskillgroup', 'teccom.pkg', '=', 'dfskillgroup.pkg')
                            ->join('dfsubskill', 'teccom.pks', '=', 'dfsubskill.pks')
                            ->whereIn("teccom.pks",$cari4)
                            ->whereIn("teccom.pkg",$cari3)
                            ->paginate(10);
                        }
                    }
                }
                else{
                    if(!($cari3)) {
                        if(!($cari4)) {
                            $cari4 = "";
                            $cari3 = "";
                            $cari = "";
                            $teccom = DB::table('teccom')
                            ->join('dfindustri', 'teccom.pki', '=', 'dfindustri.pki')
                            ->join('dfskillgroup', 'teccom.pkg', '=', 'dfskillgroup.pkg')
                            ->join('dfsubskill', 'teccom.pks', '=', 'dfsubskill.pks')
                            ->whereIn("teccom.pki",$cari2)
                            ->paginate(10);
                        }
                        else{
                            $cari3 = "";
                            $cari = "";
                            $teccom = DB::table('teccom')
                                ->join('dfindustri', 'teccom.pki', '=', 'dfindustri.pki')
                                ->join('dfskillgroup', 'teccom.pkg', '=', 'dfskillgroup.pkg')
                                ->join('dfsubskill', 'teccom.pks', '=', 'dfsubskill.pks')
                                ->whereIn("teccom.pks",$cari4)
                                ->whereIn("teccom.pki",$cari2)
                                ->paginate(10);
                        }
                    }
                    else{
                        if(!($cari4)) {
                            $cari4 = "";
                            $cari = "";
                            $teccom = DB::table('teccom')
                            ->join('dfindustri', 'teccom.pki', '=', 'dfindustri.pki')
                            ->join('dfskillgroup', 'teccom.pkg', '=', 'dfskillgroup.pkg')
                            ->join('dfsubskill', 'teccom.pks', '=', 'dfsubskill.pks')
                            ->whereIn("teccom.pkg",$cari3)
                            ->whereIn("teccom.pki",$cari2)
                            ->paginate(10);
                        }
                        else{

                            $cari = "";
                            $teccom = DB::table('teccom')
                                ->join('dfindustri', 'teccom.pki', '=', 'dfindustri.pki')
                                ->join('dfskillgroup', 'teccom.pkg', '=', 'dfskillgroup.pkg')
                                ->join('dfsubskill', 'teccom.pks', '=', 'dfsubskill.pks')
                                ->whereIn("teccom.pks",$cari4)
                                ->whereIn("teccom.pkg",$cari3)
                                ->whereIn("teccom.pki",$cari2)
                                ->paginate(10);
                            }
                        }
                }
		}
		else {
            $keyw = $cari;
            if(!($cari2)) {
                if(!($cari3)) {
                    if(!($cari4)) {
                        $cari4 = "";
                        $cari3 = "";
                        $cari2 = "";
                        $teccom = DB::table('teccom')
                        ->join('dfindustri', 'teccom.pki', '=', 'dfindustri.pki')
                        ->join('dfskillgroup', 'teccom.pkg', '=', 'dfskillgroup.pkg')
                        ->join('dfsubskill', 'teccom.pks', '=', 'dfsubskill.pks')
                        ->where(function($query) use ($cari){
                            return $query
                                    ->orWhere("dfindustri.Industry",'like',"%".$cari."%")
                                    ->orWhere("dfskillgroup.skillgroup",'like',"%".$cari."%")
                                    ->orWhere("dfsubskill.SubSkillGroup",'like',"%".$cari."%")
                                    ->orWhere("teccom.Definisi",'like',"%".$cari."%")
                                    ->orWhere("teccom.NamaKompetensiTeknis",'like',"%".$cari."%")
                                    ->orWhere("teccom.level1",'like',"%".$cari."%")
                                    ->orWhere("teccom.level2",'like',"%".$cari."%")
                                    ->orWhere("teccom.level3",'like',"%".$cari."%")
                                    ->orWhere("teccom.level4",'like',"%".$cari."%")
                                    ->orWhere("teccom.level5",'like',"%".$cari."%");})
                        ->paginate(10);
                    }
                    else{
                        $cari3 = "";
                        $cari2 = "";
                        $teccom = DB::table('teccom')
                            ->join('dfindustri', 'teccom.pki', '=', 'dfindustri.pki')
                            ->join('dfskillgroup', 'teccom.pkg', '=', 'dfskillgroup.pkg')
                            ->join('dfsubskill', 'teccom.pks', '=', 'dfsubskill.pks')
                            ->whereIn("teccom.pks",$cari4)
                            ->where(function($query) use ($cari){
                                return $query
                                        ->orWhere("dfskillgroup.skillgroup",'like',"%".$cari."%")
                                        ->orWhere("dfindustri.Industry",'like',"%".$cari."%")
                                        ->orWhere("teccom.Definisi",'like',"%".$cari."%")
                                        ->orWhere("teccom.NamaKompetensiTeknis",'like',"%".$cari."%")
                                        ->orWhere("teccom.level1",'like',"%".$cari."%")
                                        ->orWhere("teccom.level2",'like',"%".$cari."%")
                                        ->orWhere("teccom.level3",'like',"%".$cari."%")
                                        ->orWhere("teccom.level4",'like',"%".$cari."%")
                                        ->orWhere("teccom.level5",'like',"%".$cari."%");})
                            ->paginate(10);
                    }
                }
                else{
                    if(!($cari4)) {
                        $cari4 = "";
                        $cari2 = "";
                        $teccom = DB::table('teccom')
                        ->join('dfindustri', 'teccom.pki', '=', 'dfindustri.pki')
                        ->join('dfskillgroup', 'teccom.pkg', '=', 'dfskillgroup.pkg')
                        ->join('dfsubskill', 'teccom.pks', '=', 'dfsubskill.pks')
                        ->whereIn("teccom.pkg",$cari3)
                        ->where(function($query) use ($cari){
                            return $query
                                    ->orWhere("dfsubskill.SubSkillGroup",'like',"%".$cari."%")
                                    ->orWhere("dfindustri.Industry",'like',"%".$cari."%")
                                    ->orWhere("teccom.Definisi",'like',"%".$cari."%")
                                    ->orWhere("teccom.NamaKompetensiTeknis",'like',"%".$cari."%")
                                    ->orWhere("teccom.level1",'like',"%".$cari."%")
                                    ->orWhere("teccom.level2",'like',"%".$cari."%")
                                    ->orWhere("teccom.level3",'like',"%".$cari."%")
                                    ->orWhere("teccom.level4",'like',"%".$cari."%")
                                    ->orWhere("teccom.level5",'like',"%".$cari."%");})
                        ->paginate(10);
                    }
                    else{
                        $cari2 = "";
                        $teccom = DB::table('teccom')
                            ->join('dfindustri', 'teccom.pki', '=', 'dfindustri.pki')
                            ->join('dfskillgroup', 'teccom.pkg', '=', 'dfskillgroup.pkg')
                            ->join('dfsubskill', 'teccom.pks', '=', 'dfsubskill.pks')
                            ->whereIn("teccom.pks",$cari4)
                            ->whereIn("teccom.pkg",$cari3)
                            ->where(function($query) use ($cari){
                                return $query
                                        ->orWhere("dfindustri.Industry",'like',"%".$cari."%")
                                        ->orWhere("teccom.Definisi",'like',"%".$cari."%")
                                        ->orWhere("teccom.NamaKompetensiTeknis",'like',"%".$cari."%")
                                        ->orWhere("teccom.level1",'like',"%".$cari."%")
                                        ->orWhere("teccom.level2",'like',"%".$cari."%")
                                        ->orWhere("teccom.level3",'like',"%".$cari."%")
                                        ->orWhere("teccom.level4",'like',"%".$cari."%")
                                        ->orWhere("teccom.level5",'like',"%".$cari."%");})
                            ->paginate(10);
                        }
                    }
                }
                else{
                    if(!($cari3)) {
                        if(!($cari4)) {
                            $cari4 = "";
                            $cari3 = "";
                            $teccom = DB::table('teccom')
                            ->join('dfindustri', 'teccom.pki', '=', 'dfindustri.pki')
                            ->join('dfskillgroup', 'teccom.pkg', '=', 'dfskillgroup.pkg')
                            ->join('dfsubskill', 'teccom.pks', '=', 'dfsubskill.pks')
                            ->whereIn("teccom.pki",$cari2)
                            ->where(function($query) use ($cari){
                                return $query
                                        ->orWhere("dfskillgroup.SkillGroup",'like',"%".$cari."%")
                                        ->orWhere("dfsubskill.SubSkillGroup",'like',"%".$cari."%")
                                        ->orWhere("teccom.Definisi",'like',"%".$cari."%")
                                        ->orWhere("teccom.NamaKompetensiTeknis",'like',"%".$cari."%")
                                        ->orWhere("teccom.level1",'like',"%".$cari."%")
                                        ->orWhere("teccom.level2",'like',"%".$cari."%")
                                        ->orWhere("teccom.level3",'like',"%".$cari."%")
                                        ->orWhere("teccom.level4",'like',"%".$cari."%")
                                        ->orWhere("teccom.level5",'like',"%".$cari."%");})
                            ->paginate(10);
                        }
                        else{
                            $cari3 = "";
                            $teccom = DB::table('teccom')
                                ->join('dfindustri', 'teccom.pki', '=', 'dfindustri.pki')
                                ->join('dfskillgroup', 'teccom.pkg', '=', 'dfskillgroup.pkg')
                                ->join('dfsubskill', 'teccom.pks', '=', 'dfsubskill.pks')
                                ->whereIn("teccom.pks",$cari4)
                                ->whereIn("teccom.pki",$cari2)
                                ->where(function($query) use ($cari){
                                    return $query
                                            ->orWhere("dfskillgroup.SkillGroup",'like',"%".$cari."%")
                                            ->orWhere("teccom.Definisi",'like',"%".$cari."%")
                                            ->orWhere("teccom.NamaKompetensiTeknis",'like',"%".$cari."%")
                                            ->orWhere("teccom.level1",'like',"%".$cari."%")
                                            ->orWhere("teccom.level2",'like',"%".$cari."%")
                                            ->orWhere("teccom.level3",'like',"%".$cari."%")
                                            ->orWhere("teccom.level4",'like',"%".$cari."%")
                                            ->orWhere("teccom.level5",'like',"%".$cari."%");})
                                ->paginate(10);
                        }
                    }
                    else{
                        if(!($cari4)) {
                            $cari4 = "";
                            $teccom = DB::table('teccom')
                            ->join('dfindustri', 'teccom.pki', '=', 'dfindustri.pki')
                            ->join('dfskillgroup', 'teccom.pkg', '=', 'dfskillgroup.pkg')
                            ->join('dfsubskill', 'teccom.pks', '=', 'dfsubskill.pks')
                            ->where([["teccom.pkg",'=',$cari3],["teccom.pki",'=',$cari2]])
                            ->where(function($query) use ($cari){
                                return $query
                                    ->orWhere("dfsubskill.subskillgroup",'like',"%".$cari."%")
                                    ->orWhere("teccom.Definisi",'like',"%".$cari."%")
                                    ->orWhere("teccom.NamaKompetensiTeknis",'like',"%".$cari."%")
                                    ->orWhere("teccom.level1",'like',"%".$cari."%")
                                    ->orWhere("teccom.level2",'like',"%".$cari."%")
                                    ->orWhere("teccom.level3",'like',"%".$cari."%")
                                    ->orWhere("teccom.level4",'like',"%".$cari."%")
                                    ->orWhere("teccom.level5",'like',"%".$cari."%");})
                            ->paginate(10);
                            
                        }
                        else{
                            $teccom = DB::table('teccom')
                                ->join('dfindustri', 'teccom.pki', '=', 'dfindustri.pki')
                                ->join('dfskillgroup', 'teccom.pkg', '=', 'dfskillgroup.pkg')
                                ->join('dfsubskill', 'teccom.pks', '=', 'dfsubskill.pks')
                                ->whereIn("teccom.pks",$cari4)
                                ->whereIn("teccom.pkg",$cari3)
                                ->whereIn("teccom.pki",$cari2)
                                ->where(function($query) use ($cari){
                                    return $query
                                            ->orWhere("teccom.Definisi",'like',"%".$cari."%")
                                            ->orWhere("teccom.NamaKompetensiTeknis",'like',"%".$cari."%")
                                            ->orWhere("teccom.level1",'like',"%".$cari."%")
                                            ->orWhere("teccom.level2",'like',"%".$cari."%")
                                            ->orWhere("teccom.level3",'like',"%".$cari."%")
                                            ->orWhere("teccom.level4",'like',"%".$cari."%")
                                            ->orWhere("teccom.level5",'like',"%".$cari."%");})
                                ->paginate(10);
                            }
                        }

                }
        }

        

        // function highlightwords($text,$word){
        //     $text = preg_replace("#". preg_quote($word).'#i','<span class="hlw")>\\0</span>',$text);
        //     return $text;
		// 	}

        // while($row = $teccomp -> fetch_ass){
        //     dd('test');
        // }

        // $teccom->appends($request->all());



        // $c4 = $c4->SkillGroup;

        

		return view('welcome',['teccom' => $teccom, 'keyw' => $keyw ,'cari' => $cari,
        'dfindustri' => $dfindustri,
        'dfskillgroup' => $dfskillgroup,
        'dfsubskill' => $dfsubskill,
        'cari' => $cari,
        'gen4'=>$gen4,
        'gen5'=>$gen5]);

	}
}
