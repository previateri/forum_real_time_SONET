<?php
namespace App\Observers;

use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Image;

class PhotoUserObserver
{
    public function creating(User $user)
    {
        if(($user->avatar instanceof UploadedFile) and $user->avatar->isValid()) {
            $this->upload($user);
        }
    }

    public function deleting(User $user)
    {
        Storage::delete($user->avatar);
    }

    public function updating(User $user)
    {

        if((is_a($user->avatar, UploadedFile::class)) and $user->avatar->isValid()) {
            $previous_image = $user->getOriginal('avatar');
            if ($this->upload($user)) {
                if(file_exists($previous_image)){
                    Storage::delete($previous_image);
                }
                if(file_exists('/thumb/' . $previous_image)){
                    Storage::delete('/thumb/' . $previous_image);
                }
            };
        }
    }

    protected function upload(User $user)
    {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $extension = $user->avatar->extension();

        if (!in_array($extension, $allowedExtensions)):
            throw new Exception('This extesion not in allowedExtensions.');

            return false;
        else:
            $name = bin2hex(openssl_random_pseudo_bytes(8));
            $name = 'avatars/' . $name . "." . $extension;
            $user->avatar->storeAs('', $name);

            $imagem = Image::make($user->avatar->getRealPath());
            $imagem->fit(250, 250)->save(public_path() . DIRECTORY_SEPARATOR . 'thumb' . DIRECTORY_SEPARATOR . $name);

            $user->avatar = $name;

            return true;
        endif;
    }
}