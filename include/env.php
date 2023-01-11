<?php namespace {
	class env {
		protected $var = [];
		public function set(string $name, string $value = null) {
			$name_chr = str_split($name);
			foreach ($name_chr as $chr) :
				if ($chr == "_") : continue; endif;
				if (!ctype_alnum($chr)) : return null; endif;
			endforeach;
			return $this->var[$name] = $this->eval($value);
		}
		public function get(string $name = null) {
			if ($name == null) : return $this->var; endif;
			$name_chr = str_split($name);
			foreach ($name_chr as $chr) :
				if ($chr == "_") : continue; endif;
				if (!ctype_alnum($chr)) : return null; endif;
			endforeach;
			if (!isset($this->var[$name])) : return null; endif;
			return $this->var[$name];
		}
		public function import(array $env = []) {
			foreach ($env as $name => $value) :
				$this->var[$name] = $this->eval($value);
			endforeach;
		}
		public function eval(string $value = null) {
			foreach ($this->var as $name => $val) :
				$value = str_replace("$" . $name, $val, $value);
			endforeach;
			return $value;
		}
	}
}