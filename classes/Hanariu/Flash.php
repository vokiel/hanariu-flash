<?php namespace Hanariu;

class Flash {

  public static $view = 'flash/bootstrap';
  public static $types = array('info','success','warning','error');

  public static function render( $view = NULL )
  {
    $messages = \Hanariu\Session::instance()->get_once('flash',array());

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

    $messages = array_merge( \Hanariu\Session::instance()->get('flash',array()), array(array( 'type' => $type, 'message' => $message)) );
    \Hanariu\Session::instance()->set('flash',$messages);
  }

  /**
   * Add info message
   * @param string $message
   */
  public static function info( $message )
  {
    \Hanariu\Flash::add('info', $message);
  }

  /**
   * Add success message
   * @param string $message
   */
  public static function success( $message )
  {
    \Hanariu\Flash::add('success', $message);
  }

  /**
   * Add warning message
   * @param string $message
   */
  public static function warning( $message )
  {
    \Hanariu\Flash::add('warning', $message);
  }

  /**
   * Add error message
   * @param string $message
   */
  public static function error( $message )
  {
    \Hanariu\Flash::add('error', $message);
  }

}