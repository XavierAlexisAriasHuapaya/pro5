<?php

    namespace App\Services;

    use Modules\Item\Models\ItemLotsGroup;

    class ItemLotsGroupService
    {

        /**
         * Devuelve un string con solo lotes
         *
         * @param $id
         *
         * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed|string
         */
        public function getLote($id)
        {
            $result = '';
            if (is_array($id)) {
                foreach ($id as $item) {
                    $result .= "/" . $item->code;
                }
            } else {
                $record = ItemLotsGroup::where('id', $id)->first();
                if ($record) {
                    $result = $record->code;
                }
            }
            return $result;
        }

        /**
         * Devuelve un string con Lote y fecha de vencimiento.
         *
         * @param $id
         *
         * @return string
         */
        public function getLoteWithDate($id)
        {
            $result = '';
            if (is_array($id)) {
                foreach ($id as $item) {
                    $result .= "/" . $item->code . " V:" . $item->date_of_due;
                }
            } else {
                $record = ItemLotsGroup::where('id', $id)->first();

                if ($record) {
                    $result = $record->code . " V:" . $record->date_of_due;
                }
            }
            return $result;
        }


        /**
         * Devuelve la fecha de vencimiento del lote
         * @param $id
         *
         * @return \Illuminate\Database\Eloquent\HigherOrderBuilderProxy|mixed|string
         */
        public function getLotDateOfDue($id){
            $result = '';
            if (is_array($id)) {
                foreach ($id as $item) {
                    $result .= "/"  . $item->date_of_due;
                }
            } else {
                $record = ItemLotsGroup::where('id', $id)->first();

                if ($record) {
                    $result = $record->date_of_due;
                }
            }
            return $result;

        }

                
        /**
         * 
         * Obtener lote y cantidad comprometida
         *
         * @param  array|int $id_lot_selected
         * @return string
         */
        public function getItemLotGroupWithQuantity($id_lot_selected)
        {
            $description = null;

            if (is_array($id_lot_selected)) 
            {
                foreach ($id_lot_selected as $key => $item) 
                {
                    $separator = $key == 0 ? '' : '<br>';
                    $description .= "{$separator} - {$item->code} <b>({$item->compromise_quantity})</b>";
                }
            } 
            else 
            {
                $description = $this->getItemLotsGroupCode($id_lot_selected);
            }

            return $description;
        }

        
        /**
         * 
         * Obtener código de lote por id
         *
         * @param  int $id
         * @return string
         */
        public function getItemLotsGroupCode($id)
        {
            $record = ItemLotsGroup::select('code')->find($id);
            $code = null;
            
            if ($record) $code = $record->code;

            return $code;
        }


    }
