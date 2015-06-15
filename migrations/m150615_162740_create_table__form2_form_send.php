<?php
/**
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010 SkeekS (�����)
 * @date 07.03.2015
 */
use yii\db\Schema;
use yii\db\Migration;

class m150615_162740_create_table__form2_form_send extends Migration
{
    public function up()
    {
        $tableExist = $this->db->getTableSchema("{{%form2_form_send}}", true);
        if ($tableExist)
        {
            return true;
        }

        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable("{{%form2_form_send}}", [
            'id'                    => Schema::TYPE_PK,

            'created_by'            => Schema::TYPE_INTEGER . ' NULL',
            'updated_by'            => Schema::TYPE_INTEGER . ' NULL',

            'created_at'            => Schema::TYPE_INTEGER . ' NULL',
            'updated_at'            => Schema::TYPE_INTEGER . ' NULL',

            'processed_by'          => Schema::TYPE_INTEGER . ' NULL', //������������ ������� ������ ������

            'data_values'           => Schema::TYPE_TEXT . ' NULL', //������ � ����� � �������������� ����
            'data_labels'           => Schema::TYPE_TEXT . ' NULL', //������ � ����� � �������������� ����

            'emails'                => Schema::TYPE_TEXT . ' NULL', //email �� ������� ���� ���������� �����������
            'phones'                => Schema::TYPE_TEXT . ' NULL', //�������� �� ������� ���� ���������� �����������
            'user_ids'              => Schema::TYPE_TEXT . ' NULL', //

            'email_message'         => Schema::TYPE_TEXT . ' NULL', //�������� �� ������� ���� ���������� �����������
            'phone_message'         => Schema::TYPE_TEXT . ' NULL', //�������� �� ������� ���� ���������� �����������

            'status'                => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 10', //������, ������� ���������, �������

            'form_id'               => Schema::TYPE_INTEGER . '(255) NULL',

            'ip'                    => Schema::TYPE_STRING . '(32) NULL',
            'page_url'              => Schema::TYPE_STRING . '(500) NULL',

            'data_server'           => Schema::TYPE_TEXT . ' NULL',
            'data_session'          => Schema::TYPE_TEXT . ' NULL',
            'data_cookie'           => Schema::TYPE_TEXT . ' NULL',
            'data_request'          => Schema::TYPE_TEXT . ' NULL',
            'additional_data'       => Schema::TYPE_TEXT . ' NULL',


        ], $tableOptions);

        $this->execute("ALTER TABLE {{%form2_form_send}} ADD INDEX(updated_by);");
        $this->execute("ALTER TABLE {{%form2_form_send}} ADD INDEX(created_by);");

        $this->execute("ALTER TABLE {{%form2_form_send}} ADD INDEX(created_at);");
        $this->execute("ALTER TABLE {{%form2_form_send}} ADD INDEX(updated_at);");

        $this->execute("ALTER TABLE {{%form2_form_send}} ADD INDEX(form_id);");
        $this->execute("ALTER TABLE {{%form2_form_send}} ADD INDEX(processed_by);");
        $this->execute("ALTER TABLE {{%form2_form_send}} ADD INDEX(status);");
        $this->execute("ALTER TABLE {{%form2_form_send}} ADD INDEX(ip);");
        $this->execute("ALTER TABLE {{%form2_form_send}} ADD INDEX(page_url);");

        $this->execute("ALTER TABLE {{%form2_form_send}} COMMENT = '��������� � ����';");

        $this->addForeignKey(
            'form2_form_send_created_by', "{{%form2_form_send}}",
            'created_by', '{{%cms_user}}', 'id', 'SET NULL', 'SET NULL'
        );

        $this->addForeignKey(
            'form2_form_send_updated_by', "{{%form2_form_send}}",
            'updated_by', '{{%cms_user}}', 'id', 'SET NULL', 'SET NULL'
        );
        
        $this->addForeignKey(
            'form2_form_send_form_id', "{{%form2_form_send}}",
            'form_id', '{{%form2_form}}', 'id', 'SET NULL', 'SET NULL'
        );


        $this->addForeignKey(
            'form2_form_send_processed_by', "{{%form2_form_send}}",
            'processed_by', '{{%cms_user}}', 'id', 'SET NULL', 'SET NULL'
        );
    }

    public function down()
    {
        $this->dropForeignKey("form2_form_send_created_by", "{{%form2_form_send}}");
        $this->dropForeignKey("form2_form_send_updated_by", "{{%form2_form_send}}");
        $this->dropForeignKey("form2_form_send_processed_by", "{{%form2_form_send}}");

        $this->dropForeignKey("form2_form_send_form_id", "{{%form2_form_send}}");

        $this->dropTable("{{%form2_form_send}}");
    }
}
