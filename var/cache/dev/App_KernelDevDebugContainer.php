<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerPkAZ7oo\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerPkAZ7oo/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerPkAZ7oo.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerPkAZ7oo\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerPkAZ7oo\App_KernelDevDebugContainer([
    'container.build_hash' => 'PkAZ7oo',
    'container.build_id' => '06b1254f',
    'container.build_time' => 1712657547,
    'container.runtime_mode' => \in_array(\PHP_SAPI, ['cli', 'phpdbg', 'embed'], true) ? 'web=0' : 'web=1',
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerPkAZ7oo');