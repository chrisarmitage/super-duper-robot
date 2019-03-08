<?php

namespace Sdr\Domain;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Basket
{
    /**
     * @var BasketId
     */
    protected $id;

    /**
     * @var SessionId
     */
    protected $sessionId;

    /**
     * @var integer
     */
    protected $total = 0;

    /**
     * @var \DateTimeImmutable
     */
    protected $created;

    /**
     * @var \DateTimeImmutable
     */
    protected $modified;

    /**
     * @var Collection
     */
    protected $items;

    /**
     * Basket constructor.
     * @param BasketId           $id
     * @param SessionId          $sessionId
     * @param \DateTimeImmutable $created
     * @param \DateTimeImmutable $modified
     */
    public function __construct(BasketId $id, SessionId $sessionId, \DateTimeImmutable $created, \DateTimeImmutable $modified)
    {
        $this->id = $id;
        $this->sessionId = $sessionId;
        $this->created = $created;
        $this->modified = $modified;
        $this->items = new ArrayCollection();
    }

    /**
     * @return BasketId
     */
    public function getId(): BasketId
    {
        return $this->id;
    }

    /**
     * @return SessionId
     */
    public function getSessionId(): SessionId
    {
        return $this->sessionId;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getCreated(): \DateTimeImmutable
    {
        return $this->created;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getModified(): \DateTimeImmutable
    {
        return $this->modified;
    }

    /**
     * @return Collection
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    /**
     * @param BasketItem $item
     * @return $this
     */
    public function addItem(BasketItem $item) : self
    {
        $this->items->add($item);

        return $this;
    }

    public function removeItem(BasketItemId $basketItemId): void
    {
        /** @var BasketItem $item */
        foreach ($this->getItems() as $item) {
            if ($item->getId()->equals($basketItemId)) {
                $this->items->removeElement($item);
            }
        }
    }
}
