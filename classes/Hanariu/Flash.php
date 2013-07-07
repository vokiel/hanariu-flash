<?php namespace Hanariu;

use \Hanariu\Session as Session;
use \Hanariu\View as View;

class Flash {

  public static $view = 'flash/bootstrap';
  public static $types = array('info','success','warning','error');

  public static function render( $view = NULL )
  {
    $messages = Session::instance()->get_once('flash',array());

    if ($view === NULL)
    {
      $view = \Hanariu\Flash::$view;
    }

    if ( ! $view instanceof \Hanariu\View)
    {
      $view = \Hanariu\View::factory($view);
    }

    return $view->set('messages', $messages)->render();

  }

  /**
   * Add new message of type: <ul><li>info,</li><li>success,</li><li>warning,</li><li>error,</li></ul>
   * @param string $type
   * @param string $message
   */
  public static function add( $type='info', $message )
  {
    if ( !in_array($type,\Hanariu\Flash::$types) )
    {
      $type = \Hanariu\Flash::$types[0];
    }

    $messages = array_merge( Session::instance()->get('flash',array()), array(array( 'type' => $type, 'message' => $message)) );
    Session::instance()->set('flash',$messages);
  }

  /**
   * Add info message
   * @param string $message
   */
  public static function info( $message )
  {
    Flash::add('info', $message);
  }

  /**
   * Add success message
   * @param string $message
   */
  public static function success( $message )
  {
    Flash::add('success', $message);
  }

  /**
   * Add warning message
   * @param string $message
   */
  public static function warning( $message )
  {
    Flash::add('warning', $message);
  }

  /**
   * Add error message
   * @param string $message
   */
  public static function error( $message )
  {
    Flash::add('error', $message);
  }

}