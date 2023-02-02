<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\Plant;
use App\Models\Certificate;
use App\Http\Resources\PlantResource;

class BalanceResource extends JsonResource
{
    public function toArray($request)
    {
        $ability = $this->maxCap;
        if( $this->uni === 'g' ){
            $ability = $this->maxCap / 1000;
        } 
        if(($this->cls === 'III' && $ability > 80000) || ($this->cls === 'CAM' && $ability > 80000) || ($this->cls === 'II' && $ability > 41) || ($this->cls === 'I')) {
            $aux = 'not-calibrate';
        } else {
            $aux = "ok-calibrate";
        }

        $avl = count(Certificate::where('balance_id',$this->id)->where('est','!=','L')->where('est','!=','C')->get());
        
        return [
            'key' => $this->id,
            'itemClass' => $aux,
            'descBl' => $this->descBl,
            'ident' => $this->ident,
            'tip' => $this->tip,
            'marc' => $this->marc,
            'modl' => $this->modl,
            'cls' => $this->cls,
            'ser' => $this->ser,
            'uni' => $this->uni,
            'maxCap' => $this->maxCap . ' ' . '[' . $this->uni. ']',
            'usCap' => $this->usCap . ' ' . '[' .  $this->uni. ']',
            'div_e' => $this->div_e . ' ' . '[' .  $this->uni. ']',
            'div_d' => $this->div_d . ' ' . '[' .  $this->uni. ']',
            'rang' => $this->rang . ' ' . '[' .  $this->uni. ']',
            'maxCap2' => $this->maxCap2 . ' ' . '[' . $this->uni. ']',
            'usCap2' => $this->usCap2 . ' ' . '[' .  $this->uni. ']',
            'div_e2' => $this->div_e2 . ' ' . '[' .  $this->uni. ']',
            'div_d2' => $this->div_d2 . ' ' . '[' .  $this->uni. ']',
            'rang2' => $this->rang2 . ' ' . '[' .  $this->uni. ']',
            'tolr' => $this->tolr,
            'cert' => $this->cert,
            'avl' => $avl,
            'plant' => new PlantResource(Plant::find($this->plant_id))
        ];
    }
}
