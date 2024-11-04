<?php

namespace app\models;

use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "offers".
 *
 * @property int $id
 * @property string $title
 * @property string $email
 * @property string|null $phone
 * @property string|null $created_at
 */
class Offers extends \yii\db\ActiveRecord
{
    public $search;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'offers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['title', 'email'], 'required', 'on' => 'create'],
            [['title', 'email', 'phone'], 'safe', 'on' => 'create'],
            [['title', 'email'], 'required', 'on' => 'update'],
            [['search', 'created_at'], 'safe'],
            [['title', 'email', 'phone'], 'string'],
            [['email'], 'unique'],
            ['phone', 'match', 'pattern' => '/^\d{10,15}$/',
                'message' => 'Телефон должен содержать от 10 до 15 цифр',
                'skipOnEmpty' => true],
            ['email', 'email', 'message' => 'Введите корректный адрес электронной почты.'],

        ];
    }

    public function scenarios(): array
    {
        return [
            'create' => ['title', 'email'],
            'update' => ['title', 'email'],
            'default' => []
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'email' => 'Email',
            'phone' => 'Phone',
            'created_at' => 'Created At',
        ];
    }

//    Поиск реализован здесь
    public function search($params): ActiveDataProvider
    {
        $query = Offers::find();
        $this->search = $params['search'] ?? null;

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query
            ->orFilterWhere(['like', 'title', $this->search])
            ->orFilterWhere(['like', 'email', $this->search])
            ->orFilterWhere(['like', 'phone', $this->search])
            ->orFilterWhere(['like', 'created_at', $this->search]);

        return $dataProvider;
    }
}
