# ColocManager - Frontend

Frontend HTML/Tailwind/JS pour l'application de gestion de colocations.

## 📁 Structure des fichiers

```
colocation-app/
├── login.html          # Page de connexion
├── register.html       # Page d'inscription
├── dashboard.html      # Tableau de bord principal
├── colocation.html     # Détails de la colocation
├── expenses.html       # Gestion des dépenses avec filtres
├── balances.html       # Soldes et remboursements
├── members.html        # Gestion des membres
├── admin.html          # Panel administrateur
└── README.md           # Ce fichier
```

## 🚀 Technologies utilisées

- **HTML5** - Structure sémantique
- **Tailwind CSS (CDN)** - Framework CSS utilitaire
- **Font Awesome** - Icônes
- **JavaScript vanilla** - Interactivité (pas de framework JS complexe)

## 📋 Pages disponibles

### 1. Authentification
- `login.html` - Formulaire de connexion
- `register.html` - Formulaire d'inscription

### 2. Utilisateur connecté
- `dashboard.html` - Vue d'ensemble avec statistiques et actions rapides
- `colocation.html` - Gestion de la colocation (modifier, annuler)
- `expenses.html` - Liste des dépenses avec filtres par mois/catégorie/membre
- `balances.html` - Visualisation des soldes et remboursements simplifiés
- `members.html` - Gestion des membres (inviter, retirer)

### 3. Administration
- `admin.html` - Panel admin avec statistiques globales et gestion des utilisateurs

## 🔌 Intégration avec Laravel

### Structure recommandée pour le backend

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── ColocationController.php
│   │   ├── ExpenseController.php
│   │   ├── MemberController.php
│   │   └── AdminController.php
│   └── Middleware/
│       └── AdminMiddleware.php
├── Models/
│   ├── User.php
│   ├── Colocation.php
│   ├── Expense.php
│   ├── Category.php
│   ├── Membership.php
│   ├── Invitation.php
│   └── Payment.php
└── ...
```

### Routes API suggérées

```php
// routes/api.php

// Auth
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Colocations
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/colocations', [ColocationController::class, 'index']);
    Route::post('/colocations', [ColocationController::class, 'store']);
    Route::get('/colocations/{id}', [ColocationController::class, 'show']);
    Route::put('/colocations/{id}', [ColocationController::class, 'update']);
    Route::delete('/colocations/{id}', [ColocationController::class, 'destroy']);
    Route::post('/colocations/{id}/cancel', [ColocationController::class, 'cancel']);
    
    // Members
    Route::post('/colocations/{id}/invite', [MemberController::class, 'invite']);
    Route::post('/invitations/{token}/accept', [MemberController::class, 'accept']);
    Route::post('/invitations/{token}/reject', [MemberController::class, 'reject']);
    Route::delete('/colocations/{id}/members/{userId}', [MemberController::class, 'remove']);
    Route::post('/colocations/{id}/leave', [MemberController::class, 'leave']);
    
    // Expenses
    Route::get('/colocations/{id}/expenses', [ExpenseController::class, 'index']);
    Route::post('/colocations/{id}/expenses', [ExpenseController::class, 'store']);
    Route::put('/expenses/{id}', [ExpenseController::class, 'update']);
    Route::delete('/expenses/{id}', [ExpenseController::class, 'destroy']);
    
    // Balances
    Route::get('/colocations/{id}/balances', [ExpenseController::class, 'balances']);
    Route::post('/colocations/{id}/payments', [ExpenseController::class, 'recordPayment']);
    
    // Categories
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
});

// Admin routes
Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
    Route::get('/stats', [AdminController::class, 'stats']);
    Route::get('/users', [AdminController::class, 'users']);
    Route::post('/users/{id}/ban', [AdminController::class, 'ban']);
    Route::post('/users/{id}/unban', [AdminController::class, 'unban']);
    Route::get('/colocations', [AdminController::class, 'colocations']);
});
```

## 🎨 Personnalisation

### Couleurs Tailwind utilisées

- **Primaire**: `indigo-600` (boutons principaux, liens actifs)
- **Succès**: `green-600` (soldes positifs, paiements)
- **Danger**: `red-600` (suppression, dettes)
- **Avertissement**: `yellow-600` (notifications)

### Pour changer les couleurs

Remplacez simplement les classes `indigo-*` par la couleur de votre choix :
- `bg-indigo-600` → `bg-blue-600`
- `text-indigo-600` → `text-blue-600`
- etc.

## 📱 Responsive

Toutes les pages sont responsives et fonctionnent sur :
- Desktop (sidebar fixe)
- Tablette (sidebar rétractable)
- Mobile (sidebar masquée, menu hamburger recommandé)

## 🔐 Fonctionnalités JS incluses

- Modals (création, édition, suppression)
- Filtres de dépenses par mois/catégorie/membre
- Calculs automatiques des soldes
- Confirmations avant actions critiques
- Gestion des onglets (panel admin)

## 📝 Notes pour le backend

### Gestion des tokens d'invitation

```php
// Génération du token
$token = Str::random(32);

// URL d'invitation à envoyer par email
$url = config('app.frontend_url') . '/invitation?token=' . $token;
```

### Calcul des soldes

```php
// Pour chaque membre:
// 1. Total payé = sum(expenses where payer_id = member_id)
// 2. Part individuelle = total_expenses / member_count
// 3. Solde = total_paid - individual_share
```

### Simplification des dettes

Algorithme suggéré pour minimiser les transactions :
1. Trier les membres par solde (négatif à positif)
2. Les débiteurs paient les créanciers jusqu'à équilibre

## 🛠️ Améliorations possibles

- [ ] Ajouter un menu hamburger pour mobile
- [ ] Implémenter la pagination pour les listes
- [ ] Ajouter des graphiques (Chart.js)
- [ ] Mode sombre
- [ ] Notifications toast
- [ ] Export CSV/PDF

## 📧 Contact

Pour toute question sur l'intégration avec Laravel.
