<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbonnerInfo extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'abonnes';

    protected $dates = ['dob'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'user_id', 'competence_domain_id', 'experience_sector_id', 'experience_range_id',
        'sex', 'tel', 'image_link', 'ms_situation', 'academic_level', 'mobility', 'favourite', 'current_post',
        'current_company', 'availability', 'driving_license', 'cv_link',
        'freelance','sign_up_type'];

    //profile belong to a user
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    /**
     * Each user has one competence domain

    public function competenceDomain()
    {
        return $this->belongsTo('App\Models\CompetenceDomain', 'competence_domain_id', 'id');
    }*/

    /**
     * Each user has an experience sector

    public function experienceSector()
    {
        return $this->belongsTo('App\Models\ExperienceSectors', 'experience_sector_id', 'id');
    }*/

    /**
     * Each user has an years of experience

    public function experienceRange()
    {
        return $this->belongsTo('App\Models\ExperienceRanges', 'experience_range_id', 'id');
    }*/



}
