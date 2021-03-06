<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2018/10/29
 * Time: 9:59 PM
 */

namespace EasySwoole\EasySwoole\Console\DefaultCommand;

use EasySwoole\EasySwoole\Console\CommandContainer;
use EasySwoole\EasySwoole\Console\CommandInterface;
use EasySwoole\Socket\Bean\Caller;
use EasySwoole\Socket\Bean\Response;

/**
 * 命令帮助
 * Class Help
 * @package EasySwoole\EasySwoole\Console\DefaultCommand
 */
class Help implements CommandInterface
{

    /**
     * 获取某个命令的帮助信息
     * @param Caller $caller
     * @param Response $response
     * @author: eValor < master@evalor.cn >
     */
    public function exec(Caller $caller, Response $response)
    {
        $args = $caller->getArgs();
        if (!isset($args[0])) {
            $this->help($caller, $response);
        } else {
            $actionName = $args[0];
            $call = CommandContainer::getInstance()->get($actionName);
            if ($call instanceof CommandInterface) {
                $call->help($caller, $response);
            } else {
                $response->setMessage("no help message for command {$actionName} was found.");
            }
        }
    }

    public function help(Caller $caller, Response $response)
    {
        $help = <<<HELP
        
查看某个命令的帮助信息

用法: help 命令名称

HELP;
        $response->setMessage($help);
    }
}