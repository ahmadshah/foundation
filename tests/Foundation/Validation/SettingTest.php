<?php namespace Orchestra\Foundation\Tests\Validation;

use Mockery as m;
use Illuminate\Support\Facades\Facade;
use Illuminate\Container\Container;
use Orchestra\Foundation\Validation\Setting;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Validator;

class SettingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        Facade::clearResolvedInstances();
        Facade::setFacadeApplication(new Container);
    }

    /**
     * Teardown the test environment.
     */
    public function tearDown()
    {
        m::close();
    }

    /**
     * Test Orchestra\Foundation\Validation\Setting.
     *
     * @test
     */
    public function testInstance()
    {
        $stub = new Setting;

        $this->assertInstanceOf('\Orchestra\Support\Validator', $stub);
    }

    /**
     * Test Orchestra\Foundation\Validation\Setting validation.
     *
     * @test
     */
    public function testValidation()
    {
        $input = array(
            'site_name'     => 'Orchestra Platform',
            'email_address' => 'admin@orchestraplatform.com',
            'email_driver'  => 'mail',
            'email_port'    => 25,
        );

        $rules = array(
            'site_name'     => array('required'),
            'email_address' => array('required', 'email'),
            'email_driver'  => array('required', 'in:mail,smtp,sendmail,mailgun,mandrill'),
            'email_port'    => array('numeric'),
        );

        $factory = m::mock('\Illuminate\Validation\Factory[make]', array(
            m::mock('\Symfony\Component\Translation\TranslatorInterface'),
        ));
        $validator = m::mock('\Illuminate\Validation\Validator');
        $factory->shouldReceive('make')->once()->with($input, $rules, array())->andReturn($validator);
        Validator::swap($factory);

        $events = m::mock('\Illuminate\Events\Dispatcher')->makePartial();
        $events->shouldReceive('fire')->once()->with('orchestra.validate: settings', m::any())->andReturnNull();
        Event::swap($events);

        $stub       = new Setting;
        $validation = $stub->with($input);

        $this->assertEquals($validator, $validation);
    }

    /**
     * Test Orchestra\Foundation\Validation\Setting on stmp
     * setting.
     *
     * @test
     */
    public function testValidationOnSmtp()
    {
        $input = array(
            'site_name'      => 'Orchestra Platform',
            'email_address'  => 'admin@orchestraplatform.com',
            'email_driver'   => 'smtp',
            'email_port'     => 25,
            'email_username' => 'admin@orchestraplatform.com',
            'email_password' => '123456',
        );

        $rules = array(
            'site_name'      => array('required'),
            'email_address'  => array('required', 'email'),
            'email_driver'   => array('required', 'in:mail,smtp,sendmail,mailgun,mandrill'),
            'email_port'     => array('numeric'),
            'email_username' => array('required'),
            'email_host'     => array('required'),
        );

        $factory = m::mock('\Illuminate\Validation\Factory[make]', array(
            m::mock('\Symfony\Component\Translation\TranslatorInterface'),
        ));
        $validator = m::mock('\Illuminate\Validation\Validator');
        $factory->shouldReceive('make')->once()->with($input, $rules, array())->andReturn($validator);
        Validator::swap($factory);

        $events = m::mock('\Illuminate\Events\Dispatcher')->makePartial();
        $events->shouldReceive('fire')->once()->with('orchestra.validate: settings', m::any())->andReturnNull();
        Event::swap($events);

        $stub       = new Setting;
        $validation = $stub->on('smtp')->with($input);

        $this->assertEquals($validator, $validation);
    }

    /**
     * Test Orchestra\Foundation\Validation\Setting on sendmail
     * setting.
     *
     * @test
     */
    public function testValidationOnSendmail()
    {
        $input = array(
            'site_name'      => 'Orchestra Platform',
            'email_address'  => 'admin@orchestraplatform.com',
            'email_driver'   => 'sendmail',
            'email_port'     => 25,
            'email_sendmail' => '/usr/bin/sendmail -t',
        );

        $rules = array(
            'site_name'      => array('required'),
            'email_address'  => array('required', 'email'),
            'email_driver'   => array('required', 'in:mail,smtp,sendmail,mailgun,mandrill'),
            'email_port'     => array('numeric'),
            'email_sendmail' => array('required'),
        );

        $factory = m::mock('\Illuminate\Validation\Factory[make]', array(
            m::mock('\Symfony\Component\Translation\TranslatorInterface'),
        ));
        $validator = m::mock('\Illuminate\Validation\Validator');
        $factory->shouldReceive('make')->once()->with($input, $rules, array())->andReturn($validator);
        Validator::swap($factory);

        $events = m::mock('\Illuminate\Events\Dispatcher')->makePartial();
        $events->shouldReceive('fire')->once()->with('orchestra.validate: settings', m::any())->andReturnNull();
        Event::swap($events);

        $stub       = new Setting;
        $validation = $stub->on('sendmail')->with($input);

        $this->assertEquals($validator, $validation);
    }

    /**
     * Test Orchestra\Foundation\Validation\Setting on mailgun
     * setting.
     *
     * @test
     */
    public function testValidationOnMailgun()
    {
        $input = array(
            'site_name'     => 'Orchestra Platform',
            'email_address' => 'admin@orchestraplatform.com',
            'email_driver'  => 'mailgun',
            'email_port'     => 25,
            'email_secret'  => 'auniquetoken',
            'email_domain'  => 'orchestraplatform.com',
        );

        $rules = array(
            'site_name'     => array('required'),
            'email_address' => array('required', 'email'),
            'email_driver'  => array('required', 'in:mail,smtp,sendmail,mailgun,mandrill'),
            'email_port'     => array('numeric'),
            'email_secret'  => array('required'),
            'email_domain'  => array('required'),
        );

        $factory = m::mock('\Illuminate\Validation\Factory[make]', array(
            m::mock('\Symfony\Component\Translation\TranslatorInterface'),
        ));
        $validator = m::mock('\Illuminate\Validation\Validator');
        $factory->shouldReceive('make')->once()->with($input, $rules, array())->andReturn($validator);
        Validator::swap($factory);

        $events = m::mock('\Illuminate\Events\Dispatcher')->makePartial();
        $events->shouldReceive('fire')->once()->with('orchestra.validate: settings', m::any())->andReturnNull();
        Event::swap($events);

        $stub       = new Setting;
        $validation = $stub->on('mailgun')->with($input);

        $this->assertEquals($validator, $validation);
    }

    /**
     * Test Orchestra\Foundation\Validation\Setting on mandrill
     * setting.
     *
     * @test
     */
    public function testValidationOnMandrill()
    {
        $input = array(
            'site_name'     => 'Orchestra Platform',
            'email_address' => 'admin@orchestraplatform.com',
            'email_driver'  => 'mandrill',
            'email_port'    => 25,
            'email_secret'  => 'auniquetoken',
        );

        $rules = array(
            'site_name'     => array('required'),
            'email_address' => array('required', 'email'),
            'email_driver'  => array('required', 'in:mail,smtp,sendmail,mailgun,mandrill'),
            'email_port'    => array('numeric'),
            'email_secret'  => array('required'),
        );

        $factory = m::mock('\Illuminate\Validation\Factory[make]', array(
            m::mock('\Symfony\Component\Translation\TranslatorInterface'),
        ));
        $validator = m::mock('\Illuminate\Validation\Validator');
        $factory->shouldReceive('make')->once()->with($input, $rules, array())->andReturn($validator);
        Validator::swap($factory);

        $events = m::mock('\Illuminate\Events\Dispatcher')->makePartial();
        $events->shouldReceive('fire')->once()->with('orchestra.validate: settings', m::any())->andReturnNull();
        Event::swap($events);

        $stub       = new Setting;
        $validation = $stub->on('mandrill')->with($input);

        $this->assertEquals($validator, $validation);
    }
}
