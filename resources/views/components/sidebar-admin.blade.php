<ul class="sidebar-menu">
    <li>
        <a href="{{ route('admin.dashboard') }}">
            <i class="fas fa-tachometer-alt"></i>
            <span style="padding-left: 10px;">Tableau de bord</span>
        </a>
    </li>
    <li>
        <a href="{{ route('stocks.index') }}">
            <i class="fas fa-boxes"></i>
            <span style="padding-left: 10px;">Gestion Stocks</span>
        </a>
    </li>
    <li>
        <a href="{{ route('equipements.index') }}">
            <i class="fas fa-laptop-medical"></i>
            <span style="padding-left: 10px;">Gestion Equipements</span>
        </a>
    </li>
    <li>
        <a href="{{ route('techniciens.index') }}">
            <i class="fas fa-user-cog"></i>
            <span style="padding-left: 10px;">Gestion Techniciens</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.activityLogs') }}">
            <i class="fas fa-history"></i>
            <span style="padding-left: 10px;">Historique du technicien</span>
        </a>
    </li>
    <li>
        <a href="{{ route('chatbot.index') }}">
            <i class="fas fa-robot"></i>
            <span style="padding-left: 10px;">Chatbot</span>
        </a>
    </li>
</ul>