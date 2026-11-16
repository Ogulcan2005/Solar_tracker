{{-- Elke energiekaart is apart opgeslagen, zodat je ze individueel kunt aanpassen. --}}
<div class="dashboard-cards">
    @include('dashboard.cards.opbrengst')
    @include('dashboard.cards.motorverbruik')
    @include('dashboard.cards.netto-resultaat')
</div>
