@extends('backend.layouts.app')

@section('content')
<style>
    .partners-container {
        padding: 30px;
        background: #f8f9fa;
        min-height: 100vh;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding: 20px;
        background: #ffffff;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
    }

    .partners-count {
        display: inline-block;
        background: #0088cc;
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        margin-left: 15px;
    }

    .partners-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 24px;
    }

    .partner-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
        position: relative;
        overflow: hidden;
    }

    .partner-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
    }

    .partner-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #0088cc, #00b4d8);
    }

    .partner-header {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f0f0f0;
    }

    .partner-avatar {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, #0088cc, #00b4d8);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 700;
        color: white;
        flex-shrink: 0;
    }

    .partner-info {
        flex: 1;
    }

    .partner-name {
        font-size: 18px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0 0 5px 0;
    }

    .partner-date {
        font-size: 12px;
        color: #6c757d;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .partner-details {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .detail-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }

    .detail-icon {
        width: 36px;
        height: 36px;
        min-width: 36px;
        background: #f8f9fa;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0088cc;
        font-size: 16px;
    }

    .detail-content {
        flex: 1;
    }

    .detail-label {
        font-size: 11px;
        font-weight: 600;
        color: #6c757d;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .detail-value {
        font-size: 14px;
        color: #333333;
        word-break: break-word;
    }

    .detail-value.business-text {
        line-height: 1.6;
        color: #495057;
    }

    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
    }

    .empty-icon {
        width: 120px;
        height: 120px;
        margin: 0 auto 20px;
        background: #f8f9fa;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: #dee2e6;
    }

    .empty-title {
        font-size: 24px;
        font-weight: 700;
        color: #6c757d;
        margin-bottom: 10px;
    }

    .empty-text {
        font-size: 16px;
        color: #adb5bd;
    }

    .pagination-wrapper {
        margin-top: 40px;
        display: flex;
        justify-content: center;
    }

    .pagination {
        display: flex;
        gap: 8px;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .pagination li {
        display: inline-block;
    }

    .pagination a,
    .pagination span {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 12px;
        font-size: 14px;
        font-weight: 600;
        color: #6c757d;
        background: #ffffff;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .pagination a:hover {
        background: #0088cc;
        color: #ffffff;
        border-color: #0088cc;
        transform: translateY(-2px);
    }

    .pagination .active span {
        background: #0088cc;
        color: #ffffff;
        border-color: #0088cc;
    }

    .pagination .disabled span {
        color: #dee2e6;
        cursor: not-allowed;
        background: #f8f9fa;
    }

    @media (max-width: 768px) {
        .partners-container {
            padding: 15px;
        }

        .page-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .partners-grid {
            grid-template-columns: 1fr;
        }

        .partner-card {
            padding: 20px;
        }

        .pagination a,
        .pagination span {
            min-width: 36px;
            height: 36px;
            padding: 0 10px;
            font-size: 13px;
        }
    }
</style>

<div class="partners-container">
    <div class="page-header">
        <div>
            <h1 class="page-title">
                Partner Applications
                <span class="partners-count">{{ $partners->count() }}</span>
            </h1>
        </div>
    </div>

    @if($partners->count() > 0)
        <div class="partners-grid">
            @foreach($partners as $partner)
                <div class="partner-card">
                    <div class="partner-header">
                        <div class="partner-avatar">
                            {{ strtoupper(substr($partner->name, 0, 1)) }}
                        </div>
                        <div class="partner-info">
                            <h3 class="partner-name">{{ $partner->name }}</h3>
                            <div class="partner-date">
                                <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                                {{ $partner->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>

                    <div class="partner-details">
                        <div class="detail-item">
                            <div class="detail-icon">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                                </svg>
                            </div>
                            <div class="detail-content">
                                <div class="detail-label">Email</div>
                                <div class="detail-value">{{ $partner->email }}</div>
                            </div>
                        </div>

                        @if($partner->phone)
                            <div class="detail-item">
                                <div class="detail-icon">
                                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/>
                                    </svg>
                                </div>
                                <div class="detail-content">
                                    <div class="detail-label">Phone</div>
                                    <div class="detail-value">{{ $partner->phone }}</div>
                                </div>
                            </div>
                        @endif

                        <div class="detail-item">
                            <div class="detail-icon">
                                <svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="detail-content">
                                <div class="detail-label">Business Description</div>
                                <div class="detail-value business-text">{{ $partner->business }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination-wrapper">
            {{ $partners->links() }}
        </div>
    @else
        <div class="empty-state">
            <div class="empty-icon">
                <svg width="64" height="64" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                </svg>
            </div>
            <h2 class="empty-title">No Partner Applications Yet</h2>
            <p class="empty-text">Partner applications will appear here when submitted</p>
        </div>
    @endif
</div>
@endsection
