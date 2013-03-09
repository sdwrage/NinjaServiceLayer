<?php

namespace NeoNinjaLib\Domain;

use Doctrine\ORM\Mapping as ORM;

abstract class PersistableModel extends AbstractModel
{
    /**
     * Id
     *
     * Primary identifier in the database of this entity.
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }
}
