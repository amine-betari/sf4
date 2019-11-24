<?php
/**
 * Created by PhpStorm.
 * User: aminebetari
 * Date: 09/11/19
 * Time: 23:08
 */

declare(strict_types=1);

namespace App\Entity\Compose;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

trait Metadata
{
    /**
     * @var DateTime
     * @ORM\Column(name="OBJ_created", type="datetime")
     */
    private $created;
    /**
     * @var DateTime
     * @ORM\Column(name="OBJ_updated", type="datetime")
     */
    private $updated;


    public function getCreated(): DateTime
    {
        return $this->created ?? new DateTime();
    }


    public function setCreated(DateTime $created): self
    {
        $this->created = $created;
        $this->setUpdated($created);

        return $this;
    }

    public function getUpdated(): DateTime
    {
        return $this->updated ?? new DateTime();
    }

    public function setUpdated(DateTime $updated): self
    {
        $this->updated = $updated;
        return $this;
    }

}