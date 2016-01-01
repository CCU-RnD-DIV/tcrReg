<?php

use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tcr_reg_subject')->insert([
            'subject_id' => '10001',
            'subject_name' => '國中國文',
            'subject_far' => 0,
            'subject_normal' => 0,
            'subject_priority' => 0,
            'subject_type' => 0,
            'subject_prefix' => 'A'
        ]);
        DB::table('tcr_reg_subject')->insert([
            'subject_id' => '10002',
            'subject_name' => '國小國文',
            'subject_far' => 0,
            'subject_normal' => 0,
            'subject_priority' => 0,
            'subject_type' => 1,
            'subject_prefix' => 'B'
        ]);
        DB::table('tcr_reg_subject')->insert([
            'subject_id' => '10003',
            'subject_name' => '國中自然',
            'subject_far' => 0,
            'subject_normal' => 0,
            'subject_priority' => 0,
            'subject_type' => 1,
            'subject_prefix' => 'C'
        ]);
        DB::table('tcr_reg_subject')->insert([
            'subject_id' => '10004',
            'subject_name' => '國小自然',
            'subject_far' => 0,
            'subject_normal' => 0,
            'subject_priority' => 0,
            'subject_type' => 1,
            'subject_prefix' => 'D'
        ]);
        DB::table('tcr_reg_subject')->insert([
            'subject_id' => '10005',
            'subject_name' => '國中國文',
            'subject_far' => 0,
            'subject_normal' => 0,
            'subject_priority' => 0,
            'subject_type' => 1,
            'subject_prefix' => 0
        ]);
        DB::table('tcr_reg_subject')->insert([
            'subject_id' => '10006',
            'subject_name' => '國中國文',
            'subject_far' => 0,
            'subject_normal' => 0,
            'subject_priority' => 0,
            'subject_type' => 0,
            'subject_prefix' => 0
        ]);
        DB::table('tcr_reg_subject')->insert([
            'subject_id' => '10007',
            'subject_name' => '國中國文',
            'subject_far' => 0,
            'subject_normal' => 0,
            'subject_priority' => 0,
            'subject_type' => 0,
            'subject_prefix' => 0
        ]);
        DB::table('tcr_reg_subject')->insert([
            'subject_id' => '10008',
            'subject_name' => '國中國文',
            'subject_far' => 0,
            'subject_normal' => 0,
            'subject_priority' => 0,
            'subject_type' => 0,
            'subject_prefix' => 0
        ]);
    }
}
<br>
                                {!! Form::label('reg_subject_1', '國中國文') !!}
                                {!! Form::radio('reg_subject_1', '10001') !!}
                                <br>
                                {!! Form::label('reg_subject_1', '國小國文') !!}
                                {!! Form::radio('reg_subject_1', '10002') !!}
                                <br>
                                {!! Form::label('reg_subject_1', '國中自然') !!}
                                {!! Form::radio('reg_subject_1', '10003') !!}
                                <br>
                                {!! Form::label('reg_subject_1', '國小自然') !!}
                                {!! Form::radio('reg_subject_1', '10004') !!}
                                <br>
                                {!! Form::label('reg_subject_1', '國中歷史') !!}
                                {!! Form::radio('reg_subject_1', '10005') !!}
                                <br>
                                {!! Form::label('reg_subject_1', '國中地理') !!}
                                {!! Form::radio('reg_subject_1', '10006') !!}
                                <br>
                                {!! Form::label('reg_subject_1', '國中公民') !!}
                                {!! Form::radio('reg_subject_1', '10007') !!}
                                <br>
                                {!! Form::label('reg_subject_1', '國小社會') !!}
                                {!! Form::radio('reg_subject_1', '10008') !!}