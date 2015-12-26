<?php
namespace GraphCommons\Graph;

final class Signal
{
    const NODE_CREATE     = 1,
          NODE_UPDATE     = 2,
          NODE_DELETE     = 3,
          EDGE_CREATE     = 4,
          EDGE_UPDATE     = 5,
          EDGE_DELETE     = 6,
          NODETYPE_UPDATE = 7,
          NODETYPE_DELETE = 8,
          EDGETYPE_UPDATE = 9,
          EDGETYPE_DELETE = 10;

    private $action;
    private static $actions = array(
        '',
        'node_create',
        'node_update',
        'node_delete',
        'edge_create',
        'edge_update',
        'edge_delete',
        'nodetype_update',
        'nodetype_delete',
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
                    , join(',', self::$actions)
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
        return $this->action;
    }
    final public function getParameter(string $key)
    {
        return $this->parameters[$key] ?? null;
    }
    final public function getParameters(): array
    {
        return $this->parameters;
    }
}
