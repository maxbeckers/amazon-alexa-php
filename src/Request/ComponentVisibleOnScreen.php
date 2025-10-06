<?php

declare(strict_types=1);

namespace MaxBeckers\AmazonAlexa\Request;

class ComponentVisibleOnScreen
{
    /**
     * @param ComponentVisibleOnScreen[]|null $children Array of child components
     * @param Entity[]|null $entities Array of entity data copied from the component
     * @param string|null $id Component identifier
     * @param string|null $position Position as a string
     * @param string|null $role Component role
     * @param Tags|null $tags Element tags providing additional information
     * @param array|null $transform Array of transformations
     * @param string|null $type Component type
     * @param string|null $uid Unique identifier
     * @param float|null $visibility Visibility value
     */
    public function __construct(
        public ?array $children = null,
        public ?array $entities = null,
        public ?string $id = null,
        public ?string $position = null,
        public ?string $role = null,
        public ?Tags $tags = null,
        public ?array $transform = null,
        public ?string $type = null,
        public ?string $uid = null,
        public ?float $visibility = null,
    ) {
    }

    public static function fromAmazonRequest(array $amazonRequest): self
    {
        $children = null;
        if (isset($amazonRequest['children']) && is_array($amazonRequest['children'])) {
            $children = [];
            foreach ($amazonRequest['children'] as $childData) {
                $children[] = self::fromAmazonRequest($childData);
            }
        }

        $entities = null;
        if (isset($amazonRequest['entities']) && is_array($amazonRequest['entities'])) {
            $entities = [];
            foreach ($amazonRequest['entities'] as $entityData) {
                $entities[] = Entity::fromAmazonRequest($entityData);
            }
        }

        return new self(
            children: $children,
            entities: $entities,
            id: $amazonRequest['id'] ?? null,
            position: $amazonRequest['position'] ?? null,
            role: $amazonRequest['role'] ?? null,
            tags: isset($amazonRequest['tags']) ? Tags::fromAmazonRequest($amazonRequest['tags']) : null,
            transform: $amazonRequest['transform'] ?? null,
            type: $amazonRequest['type'] ?? null,
            uid: $amazonRequest['uid'] ?? null,
            visibility: $amazonRequest['visibility'] ?? null,
        );
    }
}
