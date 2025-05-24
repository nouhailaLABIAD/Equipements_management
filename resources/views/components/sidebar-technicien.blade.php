<ul class="sidebar-menu space-y-1">
    <li>
        <a href="{{ route('technicien.dashboard') }}" class="flex items-center py-3 px-4 hover:bg-blue-50 rounded-lg transition-colors">
            <i class="fas fa-tachometer-alt text-blue-600 w-5 mr-3"></i>
            <span class="font-medium">Tableau de bord</span>
        </a>
    </li>
    <li>
        <a href="{{ route('affectations.index') }}" class="flex items-center py-3 px-4 hover:bg-blue-50 rounded-lg transition-colors">
            <i class="fas fa-exchange-alt text-blue-600 w-5 mr-3"></i>
            <span class="font-medium">Affectation Équipements</span>
        </a>
    </li>
    <li>
        <a href="{{ route('members.index') }}" class="flex items-center py-3 px-4 hover:bg-blue-50 rounded-lg transition-colors">
            <i class="fas fa-user-friends text-blue-600 w-5 mr-3"></i>
            <span class="font-medium">Gestion des membres SRM</span>
        </a>
    </li>
    <li>
        <a href="{{ route('chatbot.index') }}" class="flex items-center py-3 px-4 hover:bg-blue-50 rounded-lg transition-colors">
            <i class="fas fa-comments text-blue-600 w-5 mr-3"></i>
            <span class="font-medium">Chatbot Assistance</span>
        </a>
    </li>
</ul>

<style>
.sidebar-menu a.active {
    background-color: #EFF6FF;
    border-left: 4px solid #3B82F6;
    font-weight: 500;
}
</style>