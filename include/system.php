<?php namespace {
	final class system {
		public $env;
		private static $instance;
		public function __construct(string $system_root = null) {
			if (isset(self::$instance)) :
				self::$instance = false;
			else :
				chdir($system_root);
				define("system_os", \system\os);
				define("system_api", \system\api);
				define("system_root", \system\root);
				define("directory_separator", DIRECTORY_SEPARATOR);
				self::$instance = $this;
			endif;
		}
		public function __invoke(object $hooks, array $argv = []) {
			if (self::$instance !== $this) : 
				return self::$instance = false;
			else :
				$this->env = new \system\env;
				return self::$instance = $this;
			endif;
		}
		public function __destruct() {
			if (self::$instance === $this) :
				
			else :
				self::$instance = false;
			endif;
		}
		public static function setenv(string $name, string $value = null) {
			if (!isset(self::$instance->env)) : return false; endif;
			return self::$instance->env->set($name, $value);
		}
		public static function getenv(string $name = null) {
			if (!isset(self::$instance->env)) : return false; endif;
			return self::$instance->env->get($name);
		}
	}
}
namespace system {
	const os = PHP_OS;
	const api = PHP_SAPI;
	const root = __ROOT__;
	function setenv(string $name, string $value) {
		return \system::setenv($name, $value);
	}
	function getenv(string $name = null) {
		return \system::getenv($name);
	}
}
namespace system {
	final class io {}
}

namespace system {
	final class env {
		protected $file;
		protected static $instance;
		public function __construct() {
			if (isset(self::$instance)) :
				self::$instance = false;
			else :
				$this->file = \system\root . directory_separator . ".env";
				self::$instance = new \env;
			endif;
		}
		public function set(string $name, string $value = null) {
			if (!is_object(self::$instance)) : return false; endif;
			return self::$instance->set($name, $value);
		}
		public function get(string $name = null) {
			if (!is_object(self::$instance)) : return false; endif;
			return self::$instance->get($name);

		}
	}
}

namespace system {
	final class exec extends \exec {}
}

namespace system {
	final class shell {}
}