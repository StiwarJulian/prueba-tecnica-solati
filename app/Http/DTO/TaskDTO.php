<?php

namespace App\Http\DTO;

class TaskDTO
{
    private $titulo;
    private $descripcion;
    private $estado;

    public function __construct(string $titulo, string $descripcion, string $estado)
    {
        $this->titulo = $titulo;
        $this->descripcion = $descripcion;
        $this->estado = $estado;
    }

    /**
     * Get the value of titulo
     */
    public function getTitulo(): string
    {
        return $this->titulo;
    }

    /**
     * Get the value of descripcion
     */
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    /**
     * Get the value of estado
     */
    public function getEstado(): string
    {
        return $this->estado;
    }
}
