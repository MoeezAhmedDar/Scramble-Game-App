<?php

namespace App\Traits;

trait ReturnMessage
{
    public function errorMessage($errorMessage)
    {
        $messages['danger'] = $errorMessage;
        return redirect()
            ->back()
            ->with('messages', $messages);
    }
}
