<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dépenses - ColocManager</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .sidebar { transition: all 0.3s; }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="sidebar w-64 bg-white shadow-lg fixed h-full z-10">
            <div class="p-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-home text-white"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-800">ColocManager</span>
                </div>
            </div>

            <nav class="px-4 pb-4">
                <div class="space-y-1">
                    <a href="dashboard.html" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg font-medium transition">
                        <i class="fas fa-chart-pie w-5"></i>
                        Tableau de bord
                    </a>
                    <a href="colocation.html" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg font-medium transition">
                        <i class="fas fa-house-user w-5"></i>
                        Ma Colocation
                    </a>
                    <a href="expenses.html" class="flex items-center gap-3 px-4 py-3 bg-indigo-50 text-indigo-600 rounded-lg font-medium">
                        <i class="fas fa-receipt w-5"></i>
                        Dépenses
                    </a>
                    <a href="balances.html" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg font-medium transition">
                        <i class="fas fa-scale-balanced w-5"></i>
                        Soldes
                    </a>
                    <a href="members.html" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg font-medium transition">
                        <i class="fas fa-users w-5"></i>
                        Membres
                    </a>
                                        <a href="join-colocation.html" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg font-medium transition">
                        <i class="fas fa-sign-in-alt w-5"></i>
                        Rejoindre
                    </a>
                </div>
                @can('show-administration')
                <div class="mt-8 pt-4 border-t border-gray-200">
                    <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Administration</p>
                    <a href="admin.html" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg font-medium transition">
                        <i class="fas fa-shield-alt w-5"></i>
                        Panel Admin
                    </a>
                </div>
                @endcan
            </nav>

            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-200">
                <div class="flex items-center gap-3 px-4 py-2">
                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-gray-600"></i>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-gray-900 truncate">Jean Dupont</p>
                        <p class="text-xs text-gray-500 truncate">jean@email.com</p>
                    </div>
                    <a href="login.html" class="text-gray-400 hover:text-red-500 transition">
                        <i class="fas fa-sign-out-alt"></i>
                    </a>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 ml-64 p-8 overflow-auto">
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Dépenses</h1>
                    <p class="text-gray-500 mt-1">Gérez toutes les dépenses de la colocation</p>
                </div>
                <button onclick="openAddModal()" class="bg-indigo-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-indigo-700 transition flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    Ajouter une dépense
                </button>
            </div>

            <!-- Filters -->
            <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
                <div class="flex flex-wrap items-center gap-4">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-calendar text-gray-400"></i>
                        <select id="monthFilter" onchange="filterExpenses()" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                            <option value="all">Tous les mois</option>
                            <option value="2024-02">Février 2024</option>
                            <option value="2024-01">Janvier 2024</option>
                            <option value="2023-12">Décembre 2023</option>
                            <option value="2023-11">Novembre 2023</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-filter text-gray-400"></i>
                        <select id="categoryFilter" onchange="filterExpenses()" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                            <option value="all">Toutes les catégories</option>
                            <option value="alimentation">Alimentation</option>
                            <option value="charges">Charges</option>
                            <option value="loisirs">Loisirs</option>
                            <option value="transport">Transport</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fas fa-user text-gray-400"></i>
                        <select id="memberFilter" onchange="filterExpenses()" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none">
                            <option value="all">Tous les membres</option>
                            <option value="me">Moi</option>
                            <option value="marie">Marie Lefebvre</option>
                            <option value="pierre">Pierre Durand</option>
                        </select>
                    </div>
                    <button onclick="resetFilters()" class="ml-auto px-4 py-2 text-gray-600 hover:text-indigo-600 transition">
                        <i class="fas fa-undo mr-2"></i>Réinitialiser
                    </button>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <p class="text-sm text-gray-500">Total filtré</p>
                    <p class="text-xl font-bold text-gray-800" id="totalFiltered">€1,247.50</p>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <p class="text-sm text-gray-500">Nombre de dépenses</p>
                    <p class="text-xl font-bold text-gray-800" id="countFiltered">24</p>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <p class="text-sm text-gray-500">Moyenne par dépense</p>
                    <p class="text-xl font-bold text-gray-800" id="avgFiltered">€51.98</p>
                </div>
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <p class="text-sm text-gray-500">Ma part</p>
                    <p class="text-xl font-bold text-indigo-600">€415.83</p>
                </div>
            </div>

            <!-- Expenses Table -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left py-4 px-6 text-sm font-medium text-gray-500">Description</th>
                            <th class="text-left py-4 px-6 text-sm font-medium text-gray-500">Catégorie</th>
                            <th class="text-left py-4 px-6 text-sm font-medium text-gray-500">Date</th>
                            <th class="text-left py-4 px-6 text-sm font-medium text-gray-500">Payeur</th>
                            <th class="text-right py-4 px-6 text-sm font-medium text-gray-500">Montant</th>
                            <th class="text-center py-4 px-6 text-sm font-medium text-gray-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="expensesTable">
                        <tr class="border-b border-gray-100 hover:bg-gray-50 expense-row" data-month="2024-02" data-category="alimentation" data-member="marie">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-shopping-cart text-blue-600 text-sm"></i>
                                    </div>
                                    <span class="font-medium text-gray-800">Courses hebdomadaires</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">Alimentation</span>
                            </td>
                            <td class="py-4 px-6 text-gray-600">20 février 2024</td>
                            <td class="py-4 px-6 text-gray-600">Marie Lefebvre</td>
                            <td class="py-4 px-6 text-right font-medium text-gray-800">€87.50</td>
                            <td class="py-4 px-6 text-center">
                                <button onclick="openEditExpenseModal(1)" class="text-gray-400 hover:text-indigo-600 transition mr-2">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="openDeleteModal(1)" class="text-gray-400 hover:text-red-600 transition">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-100 hover:bg-gray-50 expense-row" data-month="2024-02" data-category="charges" data-member="me">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-bolt text-purple-600 text-sm"></i>
                                    </div>
                                    <span class="font-medium text-gray-800">Facture électricité</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-medium">Charges</span>
                            </td>
                            <td class="py-4 px-6 text-gray-600">19 février 2024</td>
                            <td class="py-4 px-6 text-gray-600">Vous</td>
                            <td class="py-4 px-6 text-right font-medium text-gray-800">€124.00</td>
                            <td class="py-4 px-6 text-center">
                                <button onclick="openEditExpenseModal(2)" class="text-gray-400 hover:text-indigo-600 transition mr-2">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="openDeleteModal(2)" class="text-gray-400 hover:text-red-600 transition">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-100 hover:bg-gray-50 expense-row" data-month="2024-02" data-category="loisirs" data-member="pierre">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-utensils text-orange-600 text-sm"></i>
                                    </div>
                                    <span class="font-medium text-gray-800">Dîner entre colocs</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2 py-1 bg-orange-100 text-orange-700 rounded-full text-xs font-medium">Loisirs</span>
                            </td>
                            <td class="py-4 px-6 text-gray-600">15 février 2024</td>
                            <td class="py-4 px-6 text-gray-600">Pierre Durand</td>
                            <td class="py-4 px-6 text-right font-medium text-gray-800">€45.00</td>
                            <td class="py-4 px-6 text-center">
                                <button onclick="openEditExpenseModal(3)" class="text-gray-400 hover:text-indigo-600 transition mr-2">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="openDeleteModal(3)" class="text-gray-400 hover:text-red-600 transition">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-100 hover:bg-gray-50 expense-row" data-month="2024-02" data-category="alimentation" data-member="me">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-shopping-cart text-blue-600 text-sm"></i>
                                    </div>
                                    <span class="font-medium text-gray-800">Courses Lidl</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">Alimentation</span>
                            </td>
                            <td class="py-4 px-6 text-gray-600">12 février 2024</td>
                            <td class="py-4 px-6 text-gray-600">Vous</td>
                            <td class="py-4 px-6 text-right font-medium text-gray-800">€56.30</td>
                            <td class="py-4 px-6 text-center">
                                <button onclick="openEditExpenseModal(4)" class="text-gray-400 hover:text-indigo-600 transition mr-2">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="openDeleteModal(4)" class="text-gray-400 hover:text-red-600 transition">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-100 hover:bg-gray-50 expense-row" data-month="2024-01" data-category="charges" data-member="marie">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-wifi text-purple-600 text-sm"></i>
                                    </div>
                                    <span class="font-medium text-gray-800">Internet - Janvier</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-medium">Charges</span>
                            </td>
                            <td class="py-4 px-6 text-gray-600">28 janvier 2024</td>
                            <td class="py-4 px-6 text-gray-600">Marie Lefebvre</td>
                            <td class="py-4 px-6 text-right font-medium text-gray-800">€29.99</td>
                            <td class="py-4 px-6 text-center">
                                <button onclick="openEditExpenseModal(5)" class="text-gray-400 hover:text-indigo-600 transition mr-2">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="openDeleteModal(5)" class="text-gray-400 hover:text-red-600 transition">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <tr class="border-b border-gray-100 hover:bg-gray-50 expense-row" data-month="2024-01" data-category="transport" data-member="pierre">
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-bus text-green-600 text-sm"></i>
                                    </div>
                                    <span class="font-medium text-gray-800">Abonnement transport</span>
                                </div>
                            </td>
                            <td class="py-4 px-6">
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">Transport</span>
                            </td>
                            <td class="py-4 px-6 text-gray-600">15 janvier 2024</td>
                            <td class="py-4 px-6 text-gray-600">Pierre Durand</td>
                            <td class="py-4 px-6 text-right font-medium text-gray-800">€75.20</td>
                            <td class="py-4 px-6 text-center">
                                <button onclick="openEditExpenseModal(6)" class="text-gray-400 hover:text-indigo-600 transition mr-2">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button onclick="openDeleteModal(6)" class="text-gray-400 hover:text-red-600 transition">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Add Expense Modal -->
    <div id="addModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">Ajouter une dépense</h3>
                <button onclick="closeAddModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form method="POST" action="" id="addExpenseForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="Ex: Courses hebdomadaires" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Montant (€)</label>
                        <input name="amount" type="number" step="0.01" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" placeholder="0.00" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                        <input type="date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catégorie</label>
                    <select name="categorie_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" required>
                        <option value="">Sélectionner</option>
                        @foreach(@categories as $categorie)
                        <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeAddModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">Annuler</button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Ajouter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Expense Modal -->
    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">Modifier la dépense</h3>
                <button onclick="closeEditModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="editExpenseForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <input type="text" id="editDesc" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Montant (€)</label>
                        <input type="number" step="0.01" id="editAmount" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date</label>
                        <input type="date" id="editDate" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Catégorie</label>
                    <select id="editCategory" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 outline-none" required>
                        <option value="alimentation">Alimentation</option>
                        <option value="charges">Charges</option>
                        <option value="loisirs">Loisirs</option>
                        <option value="transport">Transport</option>
                        <option value="autre">Autre</option>
                    </select>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeEditModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">Annuler</button>
                    <button type="submit" class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-sm mx-4 text-center">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
            </div>
            <h3 class="text-lg font-bold text-gray-800 mb-2">Supprimer cette dépense ?</h3>
            <p class="text-gray-500 mb-6">Cette action est irréversible.</p>
            <div class="flex gap-3">
                <button onclick="closeDeleteModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">Annuler</button>
                <button onclick="confirmDelete()" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Supprimer</button>
            </div>
        </div>
    </div>

    <script>
        let currentExpenseId = null;

        function openAddModal() {
            document.getElementById('addModal').classList.remove('hidden');
            document.getElementById('addModal').classList.add('flex');
        }
        function closeAddModal() {
            document.getElementById('addModal').classList.add('hidden');
            document.getElementById('addModal').classList.remove('flex');
        }
        function openEditExpenseModal(id) {
            currentExpenseId = id;
            document.getElementById('editModal').classList.remove('hidden');
            document.getElementById('editModal').classList.add('flex');
        }
        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.getElementById('editModal').classList.remove('flex');
        }
        function openDeleteModal(id) {
            currentExpenseId = id;
            document.getElementById('deleteModal').classList.remove('hidden');
            document.getElementById('deleteModal').classList.add('flex');
        }
        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.add('hidden');
            document.getElementById('deleteModal').classList.remove('flex');
        }
        function confirmDelete() {
            alert('Dépense supprimée avec succès !');
            closeDeleteModal();
        }

        function filterExpenses() {
            const monthFilter = document.getElementById('monthFilter').value;
            const categoryFilter = document.getElementById('categoryFilter').value;
            const memberFilter = document.getElementById('memberFilter').value;
            
            const rows = document.querySelectorAll('.expense-row');
            let visibleCount = 0;
            let totalAmount = 0;
            
            rows.forEach(row => {
                const month = row.dataset.month;
                const category = row.dataset.category;
                const member = row.dataset.member;
                const amount = parseFloat(row.querySelector('td:nth-child(5)').textContent.replace('€', '').replace(',', '.'));
                
                const monthMatch = monthFilter === 'all' || month === monthFilter;
                const categoryMatch = categoryFilter === 'all' || category === categoryFilter;
                const memberMatch = memberFilter === 'all' || member === memberFilter;
                
                if (monthMatch && categoryMatch && memberMatch) {
                    row.style.display = '';
                    visibleCount++;
                    totalAmount += amount;
                } else {
                    row.style.display = 'none';
                }
            });
            
            document.getElementById('countFiltered').textContent = visibleCount;
            document.getElementById('totalFiltered').textContent = '€' + totalAmount.toFixed(2);
            document.getElementById('avgFiltered').textContent = visibleCount > 0 ? '€' + (totalAmount / visibleCount).toFixed(2) : '€0.00';
        }

        function resetFilters() {
            document.getElementById('monthFilter').value = 'all';
            document.getElementById('categoryFilter').value = 'all';
            document.getElementById('memberFilter').value = 'all';
            filterExpenses();
        }

        document.getElementById('addExpenseForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Dépense ajoutée avec succès !');
            closeAddModal();
        });

        document.getElementById('editExpenseForm').addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Dépense modifiée avec succès !');
            closeEditModal();
        });

        window.onclick = function(event) {
            if (event.target.classList.contains('fixed')) {
                event.target.classList.add('hidden');
                event.target.classList.remove('flex');
            }
        }
    </script>
</body>
</html>
