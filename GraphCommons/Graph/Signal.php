<?php
namespace GraphCommons\Graph;

use GraphCommons\Util\SerialTrait as Serial;

final class Signal
{
    use Serial;

    const NODE_CREATE     = 1,
          NODE_UPDATE     = 2,
          NODE_DELETE     = 3,
          EDGE_CREATE     = 4,
          EDGE_UPDATE     = 5,
          EDGE_DELETE     = 6,
          NODETYPE_CREATE = 7,
          NODETYPE_UPDATE = 8,
          NODETYPE_DELETE = 9,
          EDGETYPE_CREATE = 10,
          EDGETYPE_UPDATE = 11,
          EDGETYPE_DELETE = 12;

    private $action;
    private static $actions = array(
        '',
        'node_create',
        'node_update',
        'node_delete',
        'edge_create',
        'edge_update',
        'edge_delete',
        'nodetype_create',
        'nodetype_update',
        'nodetype_delete',
        'edgetype_create',
        'edgetype_update',
        'edgetype_delete',
    );
    private $parameters = array();

    final public function __construct(int $action = null)
    {
        if ($action != null) {
            $this->setAction($action);
        }
    }

    final public function setAction(int $action): self
    {
        if (!isset(self::$actions[$action])) {
            throw new \InvalidArgumentException(sprintf(
                'Wrong action type given, accepted actions: %s'
                    , join(',', array_slice(self::$actions, 1))
            ));
        }
        $this->action = self::$actions[$action];
        return $this;
    }
    final public function setParameter(string $key, $value): self
    {
        $this->parameters[$key] = $value;
        return $this;
    }
    final public function setParameters(array $parameters): self
    {
        $this->parameters = $parameters;
        return $this;
    }

    final public function getAction(): string
    {
        return (string) $this->action;
    }
    final public function getParameter(string $key)
    {
        return $this->parameters[$key] ?? null;
    }
    final public function getParameters(): array
    {
        return $this->parameters;
    }

    final public function unserialize(...$args): array
    {
        $array = array();
        $array['action'] = $this->getAction();
        foreach ($this->getParameters() as $key => $value) {
            $array[$key] = $value;
        }
        return $array;
    }

    final public static function detectAction($action): int
    {
        if (is_string($action)) {
            $actions = array_flip(self::$actions);
            if (isset($actions[$action])) {
                return $actions[$action];
            }
        }
        return $action;
    }
}
