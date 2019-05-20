<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */

class RoboFile extends \Robo\Tasks
{
    // define public methods as commands
    function prepareWordpress(){
      $this->_cleanDir('backend/wp-content/plugins'); // Removes default provided plugins
      $this->_cleanDir('backend/wp-content/themes'); // Removes default themes

      $this
      // @TODO: Replace this "all plugins" thing with sensible config
      // ->taskExec("git clone git@gitlab.havaslynx.com:thomas.banks/wordpress-plugins.git backend/wp-content/plugins") // Get the LxLabs plugins
      ->taskExec("wp plugin activate --all") // Activates all plugins
      // @TODO: Replace this "Nothing Theme" with a better home-made one that does better things
      ->taskExec("git clone https://github.com/khromov/wp-almost-nothing-theme.git backend/wp-content/themes/nothing-theme") // Super minimal theme for now
      ->taskExec("wp theme activate nothing-theme") // Installs and activates the Nothing theme
      ->taskExec('echo -e "<?php\n// Silence is golden." > backend/wp-content/plugins/index.php') // Replaces the removed index file
      ->run();

    }
    
    function update(){
      $this
      ->taskExec("wp core update") // Updates WordPress
      ->taskExec("wp core update-db") // Updates database
      ->taskExec("wp plugin update --all") // Updates all plugins
      ->run();
    }
    
    function install() {
      // Start the installation
      $this->say("Installation started");
      
      // Install the Backend
      $this->say("Backend installation started");
      
      $this
      ->taskExec("wp core download") // Installs WordPress into the directory given in wp-cli.yml
      ->taskExec("wp core config") // Sets up the wp-config file using the variables given in wp-cli.yml
      ->taskExec("wp core install") // Runs the "Famous 5-minute Install" in a few seconds using the variables given in wp-cli.yml
      ->run();
      
      $this->_remove('backend/wp-config-sample.php'); // Removes example config
      
      $this->prepareWordpress(); // Sets the WordPress installation up

      $this->say("Backend installation completed");

      // Install the Frontend
      $this->say("Frontend installation started");
      
      $this
      // @TODO: Replace 'create-react-app' with a more opinionated boilerplate with WP-REST support and routing
      ->taskExec("create-react-app frontend")
      ->taskExec("cd frontend && yarn && cd ..")
      ->run();

      $this->say("Backend installation completed");

      // Finish the installation
      $this->say("Installation completed 👍");
    }
  }
