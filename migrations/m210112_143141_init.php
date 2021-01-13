<?php
use yii\db\Migration;

/**
 * Class m210112_143141_init
 */
class m210112_143141_init extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Мое мнение: тут не требуется ID в качестве первичного ключа, первичный ключ здесь явно "date_at"
        $this->createTable('weather_history', [
            'id'      => $this->bigPrimaryKey()->unsigned()->comment('ID'),
            'temp'    => $this->float()->notNull()->comment('Температура'), // я бы назвал temperature
            'date_at' => $this->date()->notNull()->comment('Дата'),
                ], "ENGINE = INNODB CHARACTER SET utf8 COLLATE utf8_general_ci COMMENT='История погоды'");

        // по нему будем искать, делаем ключ
        $this->createIndex('date_at', 'weather_history', 'date_at', true); // date_at это уникальный ключ на одну и туже дату явно не может быть 2-х температур
        // с датами трабла, поэтому создаем пакет на вставку в БД
        $minTimeFrom = strtotime("-6 month");
        $lastDate = date('Y-m-d');

        $batchData = [];
        do {
            $currentDate = date('Y-m-d', $minTimeFrom);
            $batchData[] = [
                'temp'    => rand(-1000, 1000) / 10, // от -100 до +100 градусов
                'date_at' => $currentDate,
            ];
            $minTimeFrom += 3600 * 24; // добавлем +1 день
        } while ($currentDate !== $lastDate);

        $this->db->createCommand()->batchInsert('weather_history', ['temp', 'date_at'], $batchData)->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('weather_history');

        return true;
    }

    /*
      // Use up()/down() to run migration code without a transaction.
      public function up()
      {

      }

      public function down()
      {
      echo "m210112_143141_init cannot be reverted.\n";

      return false;
      }
     */
}
