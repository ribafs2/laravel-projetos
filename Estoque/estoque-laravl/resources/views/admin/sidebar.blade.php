<div class="col-md-3">
    <div class="card">
        <div class="card-header">
            Menu
        </div>

        <div class="card-body">
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/products') }}">
                        Produtos
                    </a>
                </li>
            </ul>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/buys') }}">
                        Compras
                    </a>
                </li>
            </ul>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/sales') }}">
                        Vendas
                    </a>
                </li>
            </ul>
            <ul class="nav" role="tablist">
                <li role="presentation">
                    <a href="{{ url('/inventories') }}">
                        Estoques
                    </a>
                </li>
            </ul>                    
        </div>
    </div>
</div>
