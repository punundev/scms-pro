<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
  /**
   * Display the settings page.
   */
  public function index()
  {
    // Fetch all settings and group them by the 'group' column
    $settings = Setting::all()->groupBy('group');

    return view('admin.settings.index', compact('settings'));
  }

  /**
   * Update the settings in bulk.
   */
  public function update(Request $request)
  {
    $data = $request->except('_token', '_method');

    foreach ($data as $key => $value) {
      $setting = Setting::where('key', $key)->first();

      if ($setting) {
        // Handle Image/File uploads
        if ($setting->type === 'image' && $request->hasFile($key)) {
          // Delete old image if exists
          if ($setting->value && Storage::exists('public/' . $setting->value)) {
            Storage::delete('public/' . $setting->value);
          }

          // Store new image
          $path = $request->file($key)->store('settings', 'public');
          $setting->update(['value' => $path]);
        } else {
          // Update standard text/textarea values
          $setting->update(['value' => $value]);
        }
      }
    }

    return redirect()->back()->with('success', 'Settings updated successfully!');
  }
}
