<?php

namespace App\Helpers;

class Image
{
       
    private $original = '';
    private $image = '';
    private $image_type = '';
       
 
    public function load($filename)
    {
        if (file_exists($filename)) {
              $image_info = getimagesize($filename);
 
              $this->image_type = $image_info[2];
 
            if ($this->image_type == IMAGETYPE_JPEG) {
                      $this->image = imagecreatefromjpeg($filename);
            } elseif ($this->image_type == IMAGETYPE_GIF) {
                          $this->image = imagecreatefromgif($filename);
            } elseif ($this->image_type == IMAGETYPE_PNG) {
                    $this->image = imagecreatefrompng($filename);
            }
                         
                            $this->original = $this->image;
                            return true;
        } else {
              return false;
        }
    }
 
 
    public function build($image_stream)
    {
        $this->image = imagecreatefromstring($image_stream);
        $this->original = $this->image;
    }
 
 
    public function revert()
    {
        $this->image = $this->original;
    }
 
 
    public function save($filename, $compression = 75, $permissions = null)
    {
        if ($this->image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image, $filename, $compression);
        } elseif ($this->image_type == IMAGETYPE_GIF) {
            imagegif($this->image, $filename);
        } elseif ($this->image_type == IMAGETYPE_PNG) {
            imagepng($this->image, $filename);
        } else {
            imagepng($this->image, $filename);
        }
               
        if ($permissions != null) {
            chmod($filename, $permissions);
        }
    }
 
 
    public function save_jpeg($filename, $compression = 75, $permissions = null)
    {
        imagejpeg($this->image, $filename, $compression);
        if ($permissions != null) {
            chmod($filename, $permissions);
        }
    }
 
 
    public function save_gif($filename, $permissions = null)
    {
        imagegif($this->image, $filename);
        if ($permissions != null) {
            chmod($filename, $permissions);
        }
    }
       
 
    public function save_png($filename, $permissions = null)
    {
        imagepng($this->image, $filename);
        if ($permissions != null) {
            chmod($filename, $permissions);
        }
    }
 
 
    public function output()
    {
        if ($this->image_type == IMAGETYPE_JPEG) {
            header('Content-Type: image/jpeg');
            imagejpeg($this->image);
        } elseif ($this->image_type == IMAGETYPE_GIF) {
            header('Content-Type: image/gif');
            imagegif($this->image);
        } elseif ($this->image_type == IMAGETYPE_PNG) {
            header('Content-Type: image/png');
            imagepng($this->image);
        } else {
            header('Content-Type: image/png');
            imagepng($this->image);
        }
    }
 
 
    public function output_jpeg()
    {
        header('Content-Type: image/jpeg');
        imagejpeg($this->image);
    }
 
 
    public function output_gif()
    {
        header('Content-Type: image/gif');
        imagegif($this->image);
    }
 
 
    public function output_png()
    {
        header('Content-Type: image/png');
        imagepng($this->image);
    }
 
 
    public function output_raw()
    {
        ob_start();
 
        if ($this->image_type == IMAGETYPE_JPEG) {
            imagejpeg($this->image);
        } elseif ($this->image_type == IMAGETYPE_GIF) {
            imagegif($this->image);
        } elseif ($this->image_type == IMAGETYPE_PNG) {
            imagepng($this->image);
        }
               
        $contents = ob_get_contents();
        ob_end_clean();
 
        return $contents;
    }
 
 
    public function output_raw_jpeg()
    {
                ob_start();
                imagejpeg($this->image);
                $contents = ob_get_contents();
                ob_end_clean();
                return $contents;
    }
       
 
    public function output_raw_gif()
    {
                ob_start();
                imagegif($this->image);
                $contents = ob_get_contents();
                ob_end_clean();
                return $contents;
    }
       
 
    public function output_raw_png()
    {
                ob_start();
                imagepng($this->image);
                $contents = ob_get_contents();
                ob_end_clean();
                return $contents;
    }
 
 
    public function convert_to_jpeg()
    {
        if ($this->image_type == IMAGETYPE_JPEG) {
            return;
        }
 
                ob_start();
                imagejpeg($this->image);
                $contents = ob_get_contents();
                ob_end_clean();
 
                $this->image = imagecreatefromstring($contents);
                $this->image_type = IMAGETYPE_JPEG;
    }
 
 
    public function convert_to_gif()
    {
        if ($this->image_type == IMAGETYPE_GIF) {
            return;
        }
 
                ob_start();
                imagegif($this->image);
                $contents = ob_get_contents();
                ob_end_clean();
 
                $this->image = imagecreatefromstring($contents);
                $this->image_type = IMAGETYPE_GIF;
    }
       
 
    public function convert_to_png()
    {
        if ($this->image_type == IMAGETYPE_PNG) {
            return;
        }
 
                ob_start();
                imagepng($this->image);
                $contents = ob_get_contents();
                ob_end_clean();
 
                $this->image = imagecreatefromstring($contents);
                $this->image_type = IMAGETYPE_PNG;
    }
 
 
    public function get_width()
    {
        return imagesx($this->image);
    }
 
 
    public function get_height()
    {
        return imagesy($this->image);
    }
       
 
    public function resize_to_height($height)
    {
        $ratio = $height / $this->get_height();
        $width = $this->get_width() * $ratio;
 
        $this->resize($width, $height);
    }
 
 
    public function resize_to_width($width)
    {
        $ratio = $width / $this->get_width();
        $height = $this->get_height() * $ratio;
 
        $this->resize($width, $height);
    }
 
 
    public function scale($scale)
    {
        $width = $this->get_width() * $scale/100;
        $height = $this->get_height() * $scale/100;
        $this->resize($width, $height);
    }
 
 
    public function resize($width, $height)
    {
        $new_image = imagecreatetruecolor($width, $height);
        imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->get_width(), $this->get_height());
        $this->image = $new_image;
    }
 
 
    public function crop($width, $height)
    {
                $new_image = imagecreatetruecolor($width, $height);
                $wm = $this->get_width() / $width;
                $hm = $this->get_height() / $height;
                $h_height = $height / 2;
                $w_height = $width / 2;
 
        if ($this->get_width() > $this->get_height()) {
                        $adjusted_width = $this->get_width() / $hm;
                        $half_width = $adjusted_width / 2;
                        $int_width = $half_width - $w_height;
 
                        imagecopyresampled($new_image, $this->image, -$int_width, 0, 0, 0, $adjusted_width, $height, $this->get_width(), $this->get_height());
        } elseif (($this->get_width() < $this->get_height()) || ($this->get_width() == $this->get_height())) {
                        $adjusted_height = $this->get_height() / $wm;
                        $half_height = $adjusted_height / 2;
                        $int_height = $half_height - $h_height;
 
                        imagecopyresampled($new_image, $this->image, 0, -$int_height, 0, 0, $width, $adjusted_height, $this->get_width(), $this->get_height());
        } else {
            imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $this->get_width(), $this->get_height());
        }
        $this->image = $new_image;
    }
 
 
    public function add_text($string)
    {
                $extra = 10 + (strlen($string) * 6);
                $x = $this->get_width() - $extra;
        if (x < 0) {
                $x = 0;
        }
                $y = $this->get_height() - 20;
 
                $text_color = imagecolorallocate($this->image, 0, 0, 0);
                imagestring($this->image, 2, $x, $y, $string, $text_color);
    }
 
 
    public function add_watermark($string)
    {
                $extra = 15 + (strlen($string) * 6);
                $x = $this->get_width() - $extra;
        if (x < 0) {
                $x = 0;
        }
                $y = $this->get_height() - 5;
 
                $image = imagecreatetruecolor($this->get_width(), $this->get_height());
                imagecopyresampled($image, $this->image, 0, 0, 0, 0, $this->get_width(), $this->get_height(), $this->get_width(), $this->get_height());
                $rectangle_colour = imagecolorallocatealpha($image, 0, 0, 0, 40);
                imagefilledrectangle($image, $x-10, $this->get_height()-20, $this->get_width(), $this->get_height(), $rectangle_colour);
                $text_colour = imagecolorallocate($image, 255, 255, 225);
 
        if (function_exists('imagettftext')) {
                        $font = '/usr/share/fonts/truetype/msttcorefonts/arial.ttf';
                        $font_size = 10;
                        imagettftext($image, $font_size, 0, $x, $y, $text_colour, $font, $string);
        }
        $this->image = $image;
    }
}
