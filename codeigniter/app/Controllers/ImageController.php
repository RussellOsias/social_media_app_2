<?php namespace App\Controllers;

use CodeIgniter\Controller;

class ImageController extends Controller
{
    public function profile_picture($filename)
    {
        $path = WRITEPATH . 'uploads/profile_pictures/' . $filename;

        if (is_file($path)) {
            // Determine the MIME type of the image
            $mimeType = mime_content_type($path);
            return $this->response->setHeader('Content-Type', $mimeType)
                                  ->setHeader('Content-Disposition', 'inline')
                                  ->setBody(file_get_contents($path));
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Image not found');
        }
    }
}
