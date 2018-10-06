<?php 

class ImageResizer {
	
	function resizeImage($sourceImage, $targetImage, $maxWidth, $maxHeight, $quality = 80) {
	    // Obtain image from given source file.
	    if (!$image = @imagecreatefromjpeg($sourceImage))
	    {
	        return false;
	    }
	
	    // Get dimensions of source image.
	    list($origWidth, $origHeight) = getimagesize($sourceImage);
	
	    if ($maxWidth == 0)
	    {
	        $maxWidth  = $origWidth;
	    }
	
	    if ($maxHeight == 0)
	    {
	        $maxHeight = $origHeight;
	    }
	
	    // Calculate ratio of desired maximum sizes and original sizes.
	    $widthRatio = $maxWidth / $origWidth;
	    $heightRatio = $maxHeight / $origHeight;
	
	    // Ratio used for calculating new image dimensions.
	    $ratio = min($widthRatio, $heightRatio);
	
	    // Calculate new image dimensions.
	    $newWidth  = (int)$origWidth  * $ratio;
	    $newHeight = (int)$origHeight * $ratio;
	
	    // Create final image with new dimensions.
	    $newImage = imagecreatetruecolor($newWidth, $newHeight);
	    imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
	    imagejpeg($newImage, $targetImage, $quality);
	
	    // Free up the memory.
	    imagedestroy($image);
	    imagedestroy($newImage);
	
	    return true;
	}	

	
}

	
?>