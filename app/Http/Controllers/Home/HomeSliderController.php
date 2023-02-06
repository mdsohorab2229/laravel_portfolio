<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeSlide;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class HomeSliderController extends Controller
{
    public function homeSlider()
    {
        $homeslide = HomeSlide::find(1);
        return view('admin.home_slide.home_slide_all', compact('homeslide'));
    } //end method

    public function updateSlider(Request $request)
    {

        $slide_id = $request->id;

        if (isset($slide_id)) {

            if ($request->file('home_slide')) {

                $image = $request->file('home_slide');
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                Image::make($image)->resize(636, 852)->save('upload/home_slide/' . $name_gen);
                $save_url = 'upload/home_slide/' . $name_gen;

                HomeSlide::findOrFail($slide_id)->update([
                    'title' => $request->title,
                    'short_title' => $request->short_title,
                    'video_url' => $request->video_url,
                    'home_slide' => $save_url
                ]);
                $notification = [
                    'message' => `Home Slide Update with Image Successfully`,
                    'alert_type' => 'warning'
                ];
                return redirect()->back()->with($notification);

            } else {

                HomeSlide::findOrFail($slide_id)->update([
                    'title' => $request->title,
                    'short_title' => $request->short_title,
                    'video_url' => $request->video_url,
                ]);
                $notification = [
                    'message' => 'Home Slide Update without Image Successfully',
                    'alert_type' => 'warning'
                ];
                return redirect()->back()->with($notification);

            }
        } else {
            $notification = [
                'message' => `Unknow id data`,
                'alert_type' => 'warning'
            ];
            return redirect()->back()->with($notification);
        }
    }
}
