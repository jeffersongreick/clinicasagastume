<?php

class View {

    private $file;
    private $data = array();

    public function __construct($name) {
        $this->file = 'views/' . $name . '.php';
    }

    public static function factory($view_name) {

        return new View($view_name);
    }

    public function render() {
        extract($this->data, EXTR_SKIP);
		
		// Capture the view output
		ob_start();

		try
		{
			// Load the view within the current scope
			include $this->file;
                    
		}
		catch (Exception $e)
		{
			// Delete the output buffer
			ob_end_clean();

			// Re-throw the exception
			throw $e;
		}

		// Get the captured output and close the buffer
		return ob_get_clean();
    }

    public function set($key, $value = NULL) {

        if (is_array($key)) {
            foreach ($key as $name => $value) {
                $this->data[$name] = $value;
            }
        } else {
            $this->data[$key] = $value;
        }

        return $this;
    }

     public function __toString()
    {
        return $this->render();
    }


}
