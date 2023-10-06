<th
    wire:click="setSorting('{{ $name }}')"
    class="@if($sortBy !== $name) sorting @elseif($sortDir === 'ASC') sorting_asc @else sorting_desc @endif"
    tabindex="0"
    aria-controls="DataTables_Table_0"
    rowspan="1" colspan="1"
>
    {{ $displayName }}
</th>
