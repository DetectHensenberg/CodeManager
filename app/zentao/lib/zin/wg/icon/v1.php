<?php
namespace zin;

class icon extends wg
{
    /**
     * @var mixed[]
     */
    protected static $defineProps = array(
        'name: string',
        'size?: string|int'
    );

    public function onAddChild($child)
    {
        if(is_string($child) && !$this->props->has('name'))
        {
            $this->props->set('name', $child);
            return false;
        }
    }

    protected function build()
    {
        list($name, $size) = $this->prop(array('name', 'size'));
        if(!empty($name) && !str_starts_with($name, 'icon-')) $name = "icon-$name";
        return h::i
        (
            empty($name) ? null : setClass('icon', $name),
            is_numeric($size)
                ? setStyle('font-size', "{$size}px")
                : (is_string($size)
                    ? setClass("icon-$size")
                    : null),
            set($this->props->skip(array_keys(icon::definedPropsList()))),
            $this->children()
        );
    }

    /**
     * @param string|mixed[] $nameOrProps
     * @param mixed ...$children
     * @return $this
     * @param mixed[]|null $props
     */
    public static function create($nameOrProps, $props = null, ...$children)
    {
        $props = $props ? $props : array();
        if(is_string($nameOrProps))
        {
            $props['name'] = $nameOrProps;
        }
        else
        {
            $props = array_merge($nameOrProps, $props);
        }
        return new static(set($props), ...$children);
    }
}
