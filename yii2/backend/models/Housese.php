<?php

namespace app\models;

use Yii;

use yii\web\UploadedFile;

/**
 * This is the model class for table "housese".
 *
 * @property integer $h_id
 * @property integer $u_id
 * @property integer $h_rent_type
 * @property string $h_plot_name
 * @property integer $area_id
 * @property string $h_loc_detail
 * @property integer $h_gender_demand
 * @property integer $h_room_num
 * @property integer $h_hall_num
 * @property integer $h_toilet_num
 * @property integer $h_floor_st
 * @property integer $h_floor_all
 * @property integer $h_area
 * @property integer $h_orientation
 * @property integer $h_decorate
 * @property integer $h_type
 * @property string $h_facility
 * @property double $h_price
 * @property integer $h_price_type
 * @property string $h_title
 * @property string $h_description
 * @property string $h_photo
 * @property string $h_contact_name
 * @property string $h_contact_phonenumber
 * @property string $h_pub_date
 * @property integer $h_ischeck
 * @property integer $h_issell
 * @property string $h_isdelete
 * @property integer $h_timelimit
 */
class Housese extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
      public $imageFile;
      public $h_photo;

    public static function tableName()
    {
        return 'housese';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['u_id', 'h_rent_type', 'area_id', 'h_gender_demand', 'h_room_num', 'h_hall_num', 'h_toilet_num', 'h_floor_st', 'h_floor_all', 'h_area', 'h_orientation', 'h_decorate', 'h_type', 'h_price_type', 'h_ischeck', 'h_issell', 'h_isdelete', 'h_timelimit'], 'integer'],
            [['h_price'], 'number'],
            [['h_description', 'h_photo'], 'string'],
            [['h_pub_date'], 'safe'],
            [['h_plot_name', 'h_loc_detail', 'h_facility', 'h_title', 'h_contact_name', 'h_contact_phonenumber'], 'string', 'max' => 255],
            [['h_photo'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'h_id' => 'H ID',
            'u_id' => 'U ID',
            'h_rent_type' => 'H Rent Type',
            'h_plot_name' => 'H Plot Name',
            'area_id' => 'Area ID',
            'h_loc_detail' => 'H Loc Detail',
            'h_gender_demand' => 'H Gender Demand',
            'h_room_num' => 'H Room Num',
            'h_hall_num' => 'H Hall Num',
            'h_toilet_num' => 'H Toilet Num',
            'h_floor_st' => 'H Floor St',
            'h_floor_all' => 'H Floor All',
            'h_area' => 'H Area',
            'h_orientation' => 'H Orientation',
            'h_decorate' => 'H Decorate',
            'h_type' => 'H Type',
            'h_facility' => 'H Facility',
            'h_price' => 'H Price',
            'h_price_type' => 'H Price Type',
            'h_title' => 'H Title',
            'h_description' => 'H Description',
            'h_photo' => 'H Photo',
            'h_contact_name' => 'H Contact Name',
            'h_contact_phonenumber' => 'H Contact Phonenumber',
            'h_pub_date' => 'H Pub Date',
            'h_ischeck' => 'H Ischeck',
            'h_issell' => 'H Issell',
            'h_isdelete' => 'H Isdelete',
            'h_timelimit' => 'H Timelimit',
        ];
    }
    public function upload()
    {
        
          return  $this->h_photo->saveAs('uploads/' . $this->h_photo->baseName . '.' . $this->h_photo->extension);
            
    }

}
