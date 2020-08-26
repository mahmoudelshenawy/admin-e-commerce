<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;
use Storage;

class Upload extends Controller
{
    /*
	'name',
	'size',
	'file',
	'path',
	'full_file',
	'mime_type',
	'file_type',
	'relation_id',
	 */
    public static function delete($id)
    {
        $file = File::findOrFail($id);
        if (!empty($file)) {
            Storage::delete($file->full_file);
            $file->delete();
        }
    }
    public static function upload($data = [])
    {
        if (in_array('new_name', $data)) {
            $new_name = $data['new_name'] === null ? time() : $data['new_name'];
        }

        if (request()->hasFile('file') && $data['upload_type'] == 'single') {
            Storage::has($data['delete_file']) ? Storage::delete($data['delete_file']) : '';
            return request()->file($data['file'])->store($data['path']);
        } elseif (request()->hasFile('file') && $data['upload_type'] == 'files') {

            $file = request()->file($data['file']);
            request()->file($data['file'])->store($data['path']);
            $mime = $file->getMimeType();
            $extension = $file->getClientOriginalName();
            $hashName = $file->hashName();
            $size = $file->getSize();
            $add = File::create([
                'name' => $file, //name before upload
                'size' => $size,
                'file' => $hashName,  //name after
                'path' => $data['path'],
                'full_file' => $data['path'] . '/' . $hashName,
                'mime_type' => $mime,
                'file_type' => $data['file_type'],
                'relation_id' => $data['relation_id'],
            ]);

            return $add->id;
        }
    }
}
