<?php

namespace App\Livewire\Surveys;

use App\Models\Laboratory;
use Livewire\Component;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;

class QrCodes extends Component
{
    public $laboratories = [];
    public $selectedLab = null;
    public $qrCode = null;

    public function mount()
    {
        $this->laboratories = Laboratory::where('status', 'Aktif')->orderBy('name')->get();
    }

    public function selectLab($labId)
    {
        $this->selectedLab = Laboratory::find($labId);
        $this->generateQr();
    }

    public function generateQr()
    {
        if (!$this->selectedLab) return;

        $url = route('surveys.create', ['laboratory' => $this->selectedLab->id]);

        $renderer = new ImageRenderer(
            new RendererStyle(300),
            new SvgImageBackEnd()
        );

        $writer = new Writer($renderer);
        $this->qrCode = $writer->writeString($url);
    }

    public function render()
    {
        return view('livewire.surveys.qr-codes')->layout('layouts.app');
    }
}
