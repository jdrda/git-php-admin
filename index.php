<?php
/**
 * Index page
 * 
 * Main page of the project
 * 
 * @category Index
 * @subpackage General
 * @package GitPhpAdmin
 * @author Jan Drda <jdrda@outlook.com>
 * @copyright Jan Drda
 * @license https://opensource.org/licenses/MIT MIT
 * 
 * @todo Separate code and includes
 * @todo set repository
 * @todo push force
 * @todo git reset
 * @todo remeber credentials
 */

/**
 * CONDITIONS FOR WORKING
 * 
 * 1. repo has to be initialized "git init" with apache user (so from this interface)
 * 2. repository has to be set manually "git add origin https://username/server.com/myproject.git
 * 3. credetials has to be set to remember "git config credential.helper store"
 * 4. first push has to be mady manually to get the password "git push --force origin master"
 * 5. all files has to be accessible for Apache user
 * 
 * I am going to add all these functions in near future :)
 */

/**
 * Working directory (root of git repo)
 * 
 * @var string
 */
define('GIT_ROOT', dirname(__DIR__));

/**
 * Output from command line
 * 
 * @var string
 */
$output = array();
$output1 = array();

/**
 * Change directory
 */
chdir(GIT_ROOT);

/**
 * Git init
 */
if(isset($_REQUEST['init']) == TRUE){

    exec('git init', $output);
}

/**
 * Git commit
 */
if(isset($_REQUEST['commit']) == TRUE && $_REQUEST['commit_name'] == TRUE && strlen($_REQUEST['commit_name']) > 0){

    exec('git add --all', $output);
    exec('git commit --author="'. $_REQUEST['commit_author'] .' <' . $_REQUEST['commit_email'] . '>" -am "' . $_REQUEST['commit_name'].'"', $output1);
    
    /**
     * Merge output
     */
    $output = array_merge($output, $output1);
}

/**
 * Git push
 */
if(isset($_REQUEST['push'])){

    exec('git push origin master', $output);
}

/**
 * Git push
 */
if(isset($_REQUEST['pull'])){

    exec('git pull origin master', $output);
}
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Git PHP Admin</title>
        
        <!-- CSS includes -->
        <link href="vendor/bower/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="vendor/bower/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- /CSS includes -->
    </head>
    <body>
        <div class="container">
            <h1>Git PHP Admin</h1>
            
            <!-- Controlls -->
            <div class="row">
                
                <!-- Init -->
                <div class="col-xs-6 col-xs-3">
                    <form action="" method="post">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4>Init <small>(initialize repository)</small></h4>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <button type="submit" name="init" class="btn btn-default form-control">Init</button>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <code>git init</code><br>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /Init -->
                
                <!-- Commit -->
                <div class="col-xs-6 col-xs-3">
                    <form action="" method="post">
                        <div class="panel panel-success">
                            <div class="panel-heading">
                                <h4>Commit <small>(add files and make version)</small></h4>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <label for="commit_name">Version name and comment *</label>
                                    <input name="commit_name" type="text" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="commit_author">Author's name *</label>
                                    <!-- Change the value to your name -->
                                    <input name="commit_author" type="text" class="form-control" required value='John Doe'>
                                </div>
                                <div class="form-group">
                                    <label for="commit_email">Author's e-mail *</label>
                                    <!-- Change the value to your e-mail -->
                                    <input name="commit_email" type="text" class="form-control" required value='john@doe.com'>
                                </div>
                                <div class="form-group">
                                    <button type="submit" name="commit" class="btn btn-success form-control">Commit</button>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <code>git add -all</code><br>
                                <code>git commit -am "Version name and comment"</code>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /Commit -->
                
                <!-- Push -->
                <div class="col-xs-6 col-xs-3">
                    <form action="" method="post">
                        <div class="panel panel-warning">
                            <div class="panel-heading">
                                <h4>Push <small>(save files to repository)</small></h4>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <button type="submit" name="push" class="btn btn-warning form-control">Push</button>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <code>git push</code>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /Push -->
                
                <!-- Pull -->
                <div class="col-xs-6 col-xs-3">
                    <form action="" method="post">
                        <div class="panel panel-danger">
                            <div class="panel-heading">
                                <h4>Pull <small>(restore files from repository)</small></h4>
                            </div>
                            <div class="panel-body">
                                <div class="form-group">
                                    <button type="submit" name="pull" class="btn btn-danger form-control">Pull</button>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <code>git pull</code>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /Push -->
                
            </div>
            <!-- /Controlls -->

            <!-- Output -->
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                        <label for="output">Output</label>
                        <textarea name="output" class="form-control" rows="10"><?php echo implode(PHP_EOL, $output); ?></textarea>
                    </div>
                </div>
            </div>
            <!-- /Output -->

            <!-- JS includes -->
            <script src="vendor/bower/jquery/dist/jquery.min.js"></script>
            <script src="vendor/bower/bootstrap/dist/js/bootstrap.min.js"></script>
            <!-- /JS includes -->

            <!-- JS functions -->
            <script>
                $(function () {

                    // Switch on Bootstrap Tooltips
                    $('[data-toggle="tooltip"]').tooltip();
                })
            </script>
            <!-- /JS functions -->
        
        </div>
    </body>
</html>
