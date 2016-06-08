<?php
namespace Site\CMSBundle\Pagination;

use Knp\Component\Pager\Event\Subscriber\Paginate\PaginationSubscriber;
use Knp\Component\Pager\Event\Subscriber\Sortable\SortableSubscriber;
use \Knp\Component\Pager\Paginator;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Сервис для пагинации
 * Class Pagination
 * @package Site\CMSBundle\Pagination
 */
class Pagination extends Paginator
{
    protected $session;
    public function __construct(EventDispatcherInterface $eventDispatcher = null, Session $session)
    {
        $this->session = $session;
        parent::__construct($eventDispatcher);
    }

    public function paginate($target, $page = 1, $limit = 20, array $options = array()) {
        $limit = 20;
        $limit_get = false;
        if (isset($_GET['limit'])) $limit_get = @$_GET['limit'];
        if (is_numeric($limit_get) OR $limit_get == 'all') {
            if ($limit_get == 'all')
                $limit = 99999;
            else
                $limit = $limit_get;
            $this->session->set('paginator_dynamic_limit', $limit);
            $page = 1;
        }
        if ($this->session->get('paginator_dynamic_limit'))
            $limit = $this->session->get('paginator_dynamic_limit');

        return parent::paginate($target, $page, $limit, $options);
    }

}