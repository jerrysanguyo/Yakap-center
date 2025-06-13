<?php

namespace App\Http\Controllers;

use App\Models\ChildFamily;
use App\Models\ParentsInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;

class ChildController extends Controller
{
    public function index()
    {
        $child   = Auth::user()->child->first();
        $childId = $child->id;

        $motherInfo = ParentsInfo::getMotherInfo($childId);
        $fatherInfo = ParentsInfo::getFatherInfo($childId);
        $family     = ChildFamily::getFamilyPerChild($childId);

        $templatePath = public_path('images/front_id.webp');
        $img = Image::read($templatePath);

        $overlayPath = Auth::user()->child->first()->files->where('remarks', 8)->first()->file_path; 
        $overlay = Image::read($overlayPath);
        
        $overlay->resize(340,340);
        
        $img->place($overlay, 'center', 0, 0);

        $name = trim(Auth::user()->child->first()->first_name . ' ' . Auth::user()->child->first()->middle_name . ' ' . Auth::user()->child->first()->last_name);

        $img->text($name, $img->width() / 2, 800, function($font) {
            $font->file(public_path('fonts/Roboto-Italic-VariableFont_wdth,wght.ttf'));
            $font->size(40);
            $font->color('#000000');
            $font->align('center');
            $font->valign('top');
        });
        
        $generatedFilename = "front_id_{$childId}.png";
        $img->save(public_path("images/generated/{$generatedFilename}"));

        return view('children.profile', compact(
            'motherInfo', 'fatherInfo', 'family', 'child', 'generatedFilename'
        ));
    }
}