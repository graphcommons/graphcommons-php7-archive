<?php
namespace GraphCommons\Graph;

final class Signal
{
    const ACTION_NODE_CREATE     = 1,
          ACTION_NODE_UPDATE     = 2,
          ACTION_NODE_DELETE     = 3,
          ACTION_EDGE_CREATE     = 4,
          ACTION_EDGE_UPDATE     = 5,
          ACTION_EDGE_DELETE     = 6,
          ACTION_NODETYPE_UPDATE = 7,
          ACTION_NODETYPE_DELETE = 8,
          ACTION_EDGETYPE_UPDATE = 9,
          ACTION_EDGETYPE_DELETE = 10;
    protected $action;
    protected $actions = array(
        1 => 'node_create',
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
    protected $parameters = array();

    final public function __construct(int $action = null)
    {
        if ($action != null) {
            $this->setAction($action);
        }
    }

    final public function setAction(int $action): self
    {
        if (!isset($this->actions[$action])) {
            throw new \InvalidArgumentException(sprintf(
                'Wrong action type given, accepted actions: %s'
                    , join(',', $this->$actions)
            ));
        }
        $this->action = $this->actions[$action];
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
