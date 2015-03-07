<?php
namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use app\models\Company;
use app\models\Lang;
use app\models\Vat;
use app\models\Payment;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "setting".
 *
 * The followings are the available columns in table 'setting':
 * @property integer $user_id
 * @property integer $credit
 * @property integer $vat
 * @property integer $def_company
 * @property integer $def_lang
 */
class Setting extends ActiveRecord {

    public $file;

    public static function tableName() {
	return 'setting';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return [
	    [['def_company_id','bank_code', 'account_number','def_lang_id'], 'required'],
	    [['def_vat_id','post_index','country_id'], 'integer'],
	    [['credit','surtax'], 'integer','integerOnly'=>FALSE],
        [['bank_code', 'account_number','city','street','phone','web_site','name','def_template','company_name',
            'vat_number','tax_agency','fax'], 'filter', 'filter' => 'trim'],
        [['bank_code', 'account_number','city','street','phone','vat_number','tax_agency','fax'], 'string', 'max' => 100],
        [['web_site','name','def_template'], 'string', 'max' => 200],
	    // The following rule is used by search().
	    // @todo Please remove those attributes that should not be searched.
	    [['credit', 'def_vat_id', 'def_company_id', 'def_lang_id'], 'safe', 'on' => 'search'],
        [['avatar'], 'safe'],
        ['file', 'file', 'extensions' => ['jpg','jpeg','png','gif']],
	];
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
	// NOTE: you may need to adjust the relation name and the related
	// class name for the relations automatically generated below.
	return array(
	);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
	return array(
	    'user_id' => Yii::t('app', 'ID Number'),
        'credit' => Yii::t('app', 'Credits'),
        'name' => Yii::t('app', Yii::t('app', 'Full Name')),
        'company_name' => Yii::t('app', Yii::t('app', 'Company Name')),
        'vat_number' => Yii::t('app', Yii::t('app', 'Vat')),
        'tax_agency' => Yii::t('app', Yii::t('app', 'Tax Agency')),
        'post_index' => Yii::t('app', Yii::t('app', 'Zip')),
        'phone' => Yii::t('app', Yii::t('app', 'Telephone')),
        'fax' => Yii::t('app', Yii::t('app', 'Fax')),
        'country_id' => Yii::t('app', Yii::t('app', 'Country')),
        'city' => Yii::t('app', Yii::t('app', 'City')),
        'street' => Yii::t('app', 'Address'),
        'web_site' => Yii::t('app', 'Url'),
        'file' => Yii::t('app', Yii::t('app', 'Logo')),
        'def_template' => Yii::t('app', 'Default Template'),
        'def_vat_id' =>  Yii::t('app', 'Default VAT, %'),
        'surtax' => 'Default Income Tax, %',
	    'def_company_id' => Yii::t('app', 'Default Company'),
	    'def_lang_id' => Yii::t('app', 'Default Language'),
	);
    }


    public function search() {
	// @todo Please modify the following code to remove attributes that should not be searched.

	$criteria = new CDbCriteria;

	$criteria->compare('user_id', $this->user_id);
	$criteria->compare('credit', $this->credit);
	$criteria->compare('vat', $this->vat);
	$criteria->compare('def_company', $this->def_company);
	$criteria->compare('def_lang', $this->def_lang);

	return new CActiveDataProvider($this, array(
	    'criteria' => $criteria,
	));
    }

    public static  function List_company() {
        $company = Company::find()->all();
        $list = ArrayHelper::map($company,'id', 'name'); 
	return $list;
    }

    public static  function List_lang() {
        $company = Lang::find()->all();
        $list = ArrayHelper::map($company,'id', 'name'); 
	return $list;
    }

    public static  function List_Vat() {
        $company = Vat::find()->all();
        $list = ArrayHelper::map($company,'id', 'percent');
        return $list;
    }

    public static  function List_Surtax() {
        $tax = Tax::find()->all();
        $list = ArrayHelper::map($tax,'id', 'percent');
        return $list;
    }

    public static  function List_service() {
        $company = Service::find()->all();
        $list = ArrayHelper::map($company,'id', 'name'); 
    	return $list;
    }

    public static  function List_client() {
        $client = Client::find()->where(['user_id' => Yii::$app->user->id])->all();
        $list = ArrayHelper::map($client,'id', 'name');
	return $list;
    }

    public static  function List_payment() {
        $payment = Payment::find()->all();
        $list = ArrayHelper::map($payment,'id', 'name'); 
	return $list;
    }

    public static function List_Templates()
    {
        return [
            'basic' => 'First Template',
            'second' => 'Second Template',
            'third' => 'Third Template',
        ];
    }


    public static function model($className = __CLASS__) {
	return parent::model($className);
    }

}
