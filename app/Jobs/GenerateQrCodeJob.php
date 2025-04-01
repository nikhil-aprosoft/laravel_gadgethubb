<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use App\Models\Product\Product;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class GenerateQrCodeJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $product;

    /**
     * Create a new job instance.
     */
    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $qrData = url("/api/products/{$this->product->product_id}");
        
        // // Create a safe file name
        // $fileName = "product_{$this->product->product_id}.png";
        // $filePath = "qrcodes/{$fileName}";

        // // Generate the QR code and store it
        // Storage::disk('public')->put($filePath, QrCode::format('png')->size(200)->generate($qrData));

        
        // $fullPath = Storage::disk('public')->path($filePath);
     
        // return response()->download($fullPath, basename($filePath));
        $qrData = url('/api/products/1');

        // Specify the file path within the 'public' disk
        $filePath = 'qrcodes/product_test_1.png';
     
        // Generate the QR code and store it in the specified path
        Storage::disk('public')->put($filePath, QrCode::format('png')->size(200)->generate($qrData));
     
        // Retrieve the full path to the stored file
        $fullPath = Storage::disk('public')->path($filePath);
     
        // Return the file as a response for download
        return response()->download($fullPath, basename($filePath));
    }
}
