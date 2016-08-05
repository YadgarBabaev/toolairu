<?php

namespace RleeCMS\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use XpatBundle\Entity\SimpleRef;

/**
 * EmailDb
 *
 * @ORM\Table(name="email_db")
 * @ORM\Entity(repositoryClass="RleeCMS\AdminBundle\Repository\EmailDbRepository")
 */
class EmailDb extends SimpleRef
{

}

