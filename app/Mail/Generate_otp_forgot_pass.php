<?php
namespace App\Mail;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\View;

class Generate_otp_forgot_pass extends Mailable
{
    use Queueable, SerializesModels;

    private $api_key;
    private $api_url = 'https://api.brevo.com/v3/smtp/email';
    private $data;
    private $imagePath;

    public function __construct($api_key, $data)
    {
        $this->api_key = $api_key;
        $this->data    = $data;

    }

    private function renderView($viewName, $data)
    {
        return View::make($viewName, $data)->render();
    }

    // Renamed the send method to avoid conflict with the Mailable class's send method
    public function sendOtpEmail()
    {
        $htmlContent = $this->renderView('forgot_pass_mail', ['test_message' => $this->data['text']]);

        $data = [
            'sender'      => [
                'email' => $this->data['from_email'],
                'name'  => $this->data['from_name'],
            ],
            'to'          => [
                [
                    'email' => $this->data['to_email'],
                    'name'  => $this->data['to_name'],
                ],
            ],
            'subject'     => $this->data['subject'],
            'textContent' => $this->data['text'],
            'htmlContent' => $htmlContent,
        ];

        $ch = curl_init($this->api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'api-key: ' . $this->api_key,
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response  = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            throw new Exception('cURL error: ' . curl_error($ch));
        }

        curl_close($ch);

        if ($http_code == 201) {
            return ['result' => true, 'message' => 'Email sent'];
        } else {
            return ['result' => false, 'message' => 'Failed to send email', 'response' => $response];
        }
    }

    // Required method from the Mailable class
    public function build()
    {
        return $this->view('forgot_pass_mail')
            ->with([
                'test_message' => $this->data['text'],
            ]);
    }

}
