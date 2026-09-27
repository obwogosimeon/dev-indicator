<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndicatorTarget extends Model
{
    protected $fillable = [
        'january', 
        'february',
        'march',
        'april',
        'may',
        'june',
        'july',
        'august',
        'september',
        'october',
        'november',
        'december',
        'jan_feb',
        'mar_apr',
        'may_june',
        'july_aug',
        'sep_oct',
        'nov_dec',
        'jan_march',
        'april_june',
        'july_september',
        'october_december',
        'jan_june',
        'july_december',
        'jan_december',
        'baseline',
        'target',
        'label',
        'frequency',
        'indicator_id',
        'work_plan_container_id',
        'financial_year',
        'organization_id',
        'project_id',
        'exchange_rate',
        'reporting',
        'achieved_current_period',
        'achieved_previous_period'
    ];


    public function workplancontainer()
    {
        return $this->belongsTo('App\WorkPlanContainer');
    }

    public function indicator()
    {
        return $this->belongsTo('App\Indicator');
    }

    // public function setJanDecemberAttribute($value)
    // {
    //     $this->attributes['jan_december'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getJanDecemberAttribute($value)
    // {
    //     return $this->attributes['jan_december'] = json_decode($value);
    // }


    // public function setJanJuneAttribute($value)
    // {
    //     $this->attributes['jan_june'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getJanJuneAttribute($value)
    // {
    //     return $this->attributes['jan_june'] = json_decode($value);
    // }



    // public function setJulyDecemberAttribute($value)
    // {
    //     $this->attributes['july_december'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getJulyDecemberAttribute($value)
    // {
    //     return $this->attributes['july_december'] = json_decode($value);
    // }



    // public function setJanMarchAttribute($value)
    // {
    //     $this->attributes['jan_march'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getJanMarchAttribute($value)
    // {
    //     return $this->attributes['jan_march'] = json_decode($value);
    // }



    // public function setAprilJuneAttribute($value)
    // {
    //     $this->attributes['april_june'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getAprilJuneAttribute($value)
    // {
    //     return $this->attributes['april_june'] = json_decode($value);
    // }


    // public function setJulySeptemberAttribute($value)
    // {
    //     $this->attributes['july_september'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getJulySeptemberAttribute($value)
    // {
    //     return $this->attributes['july_september'] = json_decode($value);
    // }


    // public function setOctoberDecemberAttribute($value)
    // {
    //     $this->attributes['october_december'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getOctoberDecemberAttribute($value)
    // {
    //     return $this->attributes['october_december'] = json_decode($value);
    // }



    // public function setJanFebAttribute($value)
    // {
    //     $this->attributes['jan_feb'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getJanFebAttribute($value)
    // {
    //     return $this->attributes['jan_feb'] = json_decode($value);
    // }


    // public function setMarAprAttribute($value)
    // {
    //     $this->attributes['mar_apr'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getMarAprAttribute($value)
    // {
    //     return $this->attributes['mar_apr'] = json_decode($value);
    // }



    // public function setMayJuneAttribute($value)
    // {
    //     $this->attributes['may_june'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getMayJuneAttribute($value)
    // {
    //     return $this->attributes['may_june'] = json_decode($value);
    // }


    // public function setJulyAugAttribute($value)
    // {
    //     $this->attributes['july_aug'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getJulyAugAttribute($value)
    // {
    //     return $this->attributes['july_aug'] = json_decode($value);
    // }


    // public function setSepOctAttribute($value)
    // {
    //     $this->attributes['sep_oct'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getSepOctAttribute($value)
    // {
    //     return $this->attributes['sep_oct'] = json_decode($value);
    // }


    // public function setNovDecAttribute($value)
    // {
    //     $this->attributes['nov_dec'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getNovDecAttribute($value)
    // {
    //     return $this->attributes['nov_dec'] = json_decode($value);
    // }


    // public function setJanuaryAttribute($value)
    // {
    //     $this->attributes['january'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getJanuaryAttribute($value)
    // {
    //     return $this->attributes['january'] = json_decode($value);
    // }


    // public function setFebruaryAttribute($value)
    // {
    //     $this->attributes['february'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getFebruaryAttribute($value)
    // {
    //     return $this->attributes['february'] = json_decode($value);
    // }


    // public function setMarchAttribute($value)
    // {
    //     $this->attributes['march'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getMarchAttribute($value)
    // {
    //     return $this->attributes['march'] = json_decode($value);
    // }


    // public function setAprilAttribute($value)
    // {
    //     $this->attributes['april'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getAprilAttribute($value)
    // {
    //     return $this->attributes['april'] = json_decode($value);
    // }


    // public function setMayAttribute($value)
    // {
    //     $this->attributes['may'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getMayAttribute($value)
    // {
    //     return $this->attributes['may'] = json_decode($value);
    // }


    // public function setJuneAttribute($value)
    // {
    //     $this->attributes['june'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getJuneAttribute($value)
    // {
    //     return $this->attributes['june'] = json_decode($value);
    // }

    // public function setJulyAttribute($value)
    // {
    //     $this->attributes['july'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getJulyAttribute($value)
    // {
    //     return $this->attributes['july'] = json_decode($value);
    // }


    // public function setAugustAttribute($value)
    // {
    //     $this->attributes['august'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getAugustAttribute($value)
    // {
    //     return $this->attributes['august'] = json_decode($value);
    // }


    // public function setSeptemberAttribute($value)
    // {
    //     $this->attributes['september'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getSeptemberAttribute($value)
    // {
    //     return $this->attributes['september'] = json_decode($value);
    // }

    // public function setOctoberAttribute($value)
    // {
    //     $this->attributes['october'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getOctoberAttribute($value)
    // {
    //     return $this->attributes['october'] = json_decode($value);
    // }


    // public function setNovemberAttribute($value)
    // {
    //     $this->attributes['november'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getNovemberAttribute($value)
    // {
    //     return $this->attributes['november'] = json_decode($value);
    // }


    // public function setDecemberAttribute($value)
    // {
    //     $this->attributes['december'] = json_encode($value);
    // }
  
    // /**
    //  * Get the categories
    //  *
    //  */
    // public function getDecemberAttribute($value)
    // {
    //     return $this->attributes['december'] = json_decode($value);
    // }



}
