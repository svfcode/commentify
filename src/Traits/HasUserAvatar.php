<?php

namespace Usamamuneerchaudhary\Commentify\Traits;

trait HasUserAvatar
{
    /**
     * @return string
     */
    public function avatar(): string
    {
        if ($this->profile_photo_path) {
            return '/storage/' . $this->profile_photo_path;
        }

        return 'https://gravatar.com/avatar/'.md5($this->email).'?s=80&d=mp';
    }
}
