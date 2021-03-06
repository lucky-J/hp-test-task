<?php

return [
    \App\Repository\RepositoryInterface::class =>  DI\create(\App\Repository\RequestRepository::class),
];