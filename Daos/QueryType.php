<?php namespace Daos;

    /**
     * Indica si la query es SQL plano o un Stored Procedure
     */
    abstract class QueryType {
        const Query = 0;
        const StoreProcedure = 1;
    }